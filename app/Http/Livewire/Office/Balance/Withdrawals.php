<?php

namespace App\Http\Livewire\Office\Balance;

use App\Models\Withdrawal;
use App\Models\WithdrawalMethod;
use App\Services\TransactionService;
use App\Services\WithDrawalsService;
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

	public function mount() {
		$this->office = auth()->user()->currentOffice;
	}

	protected function getFormSchema(): array
	{

		$withDrawalMethods = WithdrawalMethod::query()->whereHas('countries', function($query) {
			//return $query->where('country_id', $this->office->country_code);
		})->pluck('name', 'id');

		$withDrawalMethodsForm = [];

		if($withDrawalMethods) {
			$withDrawalMethodsForm[] = Radio::make("withdrawalMethod")
			->label("أختر طريقة السحب")
			->options($withDrawalMethods)
			->required();
		}

		$withDrawalMethodsForm[] = TextInput::make("amount")
		->type("number")
		->label("المبلغ")
		->required();


		return $withDrawalMethodsForm;
	}

	public function render()
	{
		return view("livewire.office.balance.withdrawals");
	}

	public function submit()
	{

        if($this->amount > $office->available_balance) {
            $this->addError('amount', 'المرجو التحقق من المبلغ المتوفر في الحساب.');
			return;
        }

		TransactionService::withdraw( $office, $this->amount );		

        Notification::make()
        ->title('تم ارسال طلب السحب الى الإدارة بنجاح')
        ->success()
        ->send();

	}
}
