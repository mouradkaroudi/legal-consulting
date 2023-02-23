<?php

namespace App\Http\Livewire\Payment;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use App\Services\TransactionService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class BankTransferForm extends Component implements HasForms
{
	use InteractsWithForms;

	public $transfer_number;
	public $attachments;
	public $amount;
	public $redirectRoute = null;

	protected function getFormSchema(): array
	{
		return [
			TextInput::make("amount")
				->label(__("Amount"))
				->required(),
			TextInput::make("transfer_number")
				->label(__('The financial transaction number'))
				->required(),
			FileUpload::make("attachments")->label(
				__('The transaction confirmation receipt')
			),
		];
	}

	public function save(): void
	{
		$user = auth()->user();
		$data = $this->form->getState();

		TransactionService::bankTransfer(User::find($user->id), [
			"amount" => $data["amount"],
			"metadata" => [
				"transfer_number" => $data["transfer_number"],
				"attachments" => [$data["attachments"]],
			]
		]);
	}

	public function submit()
	{
		$this->save();

		Notification::make()
			->title(__('The deposit request has been sent successfully'))
			->body(__('The amount will be added to your account once we verifies the bank transfer. Thank you for being so understanding'))
			->success()
			->send();

		$this->reset();
		if($this->redirectRoute) {
			return redirect()->route($this->redirectRoute);
		}

	}

	public function render()
	{
		return view("livewire.payment.bank-transfer-form");
	}
}
