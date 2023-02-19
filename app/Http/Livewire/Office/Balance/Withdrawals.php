<?php

namespace App\Http\Livewire\Office\Balance;

use App\Models\WithdrawalMethod;
use App\Services\TransactionService;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class Withdrawals extends Component implements HasForms
{
	use InteractsWithForms;

	public $office;
	public $amount;
	public $method;

	protected function getFormSchema(): array
	{

		$withdrawalMethodsForm = [];

		$officeWithdrawalMethods = $this->office->withdrawal_methods ?? [];

		$officeWithdrawalMethodsIds = array_column($officeWithdrawalMethods, 'method_id');

		$withdrawalMethods = WithdrawalMethod::whereIn('id', $officeWithdrawalMethodsIds)->get();

		$options = [];
		$descriptions = [];

		foreach ($withdrawalMethods as $j => $withdrawalMethod) {
			$options[$withdrawalMethod->id] = $withdrawalMethod->name;
			$descriptions[$withdrawalMethod->id] = $withdrawalMethod->description;
		}

		if (!empty($options)) {
			$withdrawalMethodsForm[] = Radio::make('method')
				->label(__('Withdrawal methods'))
				->options($options)
				->descriptions($descriptions)
				->required();

			$withdrawalMethodsForm[] = TextInput::make("amount")
				->type("number")
				->label(__("Amount"))
				->required();
		}

		return $withdrawalMethodsForm;
	}

	public function render()
	{
		return view("livewire.office.balance.withdrawals");
	}

	public function submit()
	{

		$this->resetErrorBag();

		try {
			TransactionService::withdraw($this->office, [
				'amount' => $this->amount,
				'metadata' => ['preferred_payment_method' => $this->method]
			]);

			Notification::make()
				->title(__('Your withdrawal request has been submitted. we will transfer your funds to your preferred withdraw method in the next few business days'))
				->success()
				->send();

			redirect()->route("office.credit.index");
		} catch (\Throwable $th) {
			$this->addError('amount', $th->getMessage());
		}
	}
}
