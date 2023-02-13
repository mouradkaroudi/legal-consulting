<?php

namespace App\Http\Livewire\Payment;

use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class Credit extends Component implements HasForms
{
    use InteractsWithForms;

    public $account;
    public $onlyAccount = true;
    public $entity;
    public $entityId = '';

    //TODO: credit payment should be remove and placed with subscription

    protected function getFormSchema(): array
    {

        $options = [
            'account' => __('Account balance')
        ];

        if(!$this->onlyAccount) {
            $options['office'] = __('Office balance');
        }

        return [
            Select::make('account')
                ->options($options)
        ];
    }

    public function submit() {

        $url = '';

        if($this->entity == 'subscription') {
            $url = route('office.subscription.subscribe', ['profession_subscription_plan' => $this->entityId, 'from' => $this->account]);
        }

        if($this->entity == 'order') {
            $url = route('account.orders.pay', ['order' => $this->entityId]);
        }

        return redirect($url);
    }

    public function render()
    {
        return view('livewire.payment.credit');
    }
}
