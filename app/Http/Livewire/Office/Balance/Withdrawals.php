<?php

namespace App\Http\Livewire\Office\Balance;

use App\Models\Withdrawal;
use App\Models\WithdrawalMethod;
use App\Services\TransactionService;
use App\Services\WithDrawalsService;
use Filament\Forms\Components\Placeholder;
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

	public function mount()
	{
		$this->office = auth()->user()->currentOffice;
	}

	protected function getFormSchema(): array
	{

		$office = auth()->user()->currentOffice;

		$officeWithdrawalMethods = $office->withdrawal_methods ?? [];

		$officeWithdrawalMethodsIds = array_column($officeWithdrawalMethods, 'method_id');

		$withdrawalMethods = WithdrawalMethod::whereIn('id', $officeWithdrawalMethodsIds)->get();

		$withdrawalMethodsForm = [];

		$options = [];
		$descriptions = [];

		foreach ($withdrawalMethods as $j => $withdrawalMethod) {
			$options[$withdrawalMethod->id] = $withdrawalMethod->name;
			$descriptions[$withdrawalMethod->id] = $withdrawalMethod->description;
		}

		$withdrawalMethodsForm[] = Radio::make('method')
			->label(__('Withdrawal methods'))
			->options($options)
			->descriptions($descriptions)
			->required()
			;

		if (empty($withdrawalMethodsForm)) {
			return [
				Placeholder::make('')->content(__('There is no payment method available for you. Please get in touch with our support') . '.')
			];
		}

		$withdrawalMethodsForm[] = TextInput::make("amount")
			->type("number")
			->label(__("Amount"))
			->required();

		return $withdrawalMethodsForm;
	}

	public function render()
	{
		return view("livewire.office.balance.withdrawals");
	}

	public function submit()
	{
		TransactionService::withdraw(auth()->user()->currentOffice, 10000, [
			'preffered_payment_method' => 1
		]);
	}
}
