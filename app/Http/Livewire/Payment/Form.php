<?php

namespace App\Http\Livewire\Payment;

use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;
// TODO: invite each payment separated (Subscription payment/order payment)
class Form extends Component
{

    public $method = null;

    public $entity = '';
    public $entityId = '';

    protected $listeners = [
        'balance-payment-selected' => 'rest'
    ];

    public function rest() {
        $this->method = null;
    }

    public function paymentMethodUpdated($method)
    {

    }

    public function render()
    {
        return view('livewire.payment.form');
    }


}
