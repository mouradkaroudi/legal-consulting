<?php

namespace App\Http\Livewire\Office\Balance;

use App\Models\Withdrawal;
use App\Services\TransactionService;
use App\Services\WithDrawalsService;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class Withdrawals extends Component implements HasForms
{
	use InteractsWithForms;

	public $amount;

	protected function getFormSchema(): array
	{
		return [
			TextInput::make("amount")
				->type("number")
				->label("المبلغ")
				->required(),
		];
	}

	public function render()
	{
		return view("livewire.office.balance.withdrawals");
	}

	public function submit()
	{

        $office = auth()->user()->currentOffice;

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
