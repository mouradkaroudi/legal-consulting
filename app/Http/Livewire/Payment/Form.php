<?php

namespace App\Http\Livewire\Payment;

use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;
// TODO: each payment gateway/method should be separated, consider remove this component
class Form extends Component
{

    public $method = null;

    public $entity = '';
    public $entityId = '';

    public $accpetBankTransfer = false;
    public $redirectRoute = null;

    protected $listeners = [
        'balance-payment-selected' => 'rest'
    ];

    public function mount() {
        $transactions_bank_transfer = setting('transactions_bank_transfer');
        $this->accpetBankTransfer = !empty($transactions_bank_transfer) && $transactions_bank_transfer != "false";
    }

    public function rest() {
        $this->method = null;
    }

    public function render()
    {
        return view('livewire.payment.form');
    }


}
