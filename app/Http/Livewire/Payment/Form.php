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

    public $amount = 0;
    public $totalAmount = 0;
    public $tax = 0;
    public $taxRate = 0;
    public $method = 'credit';

    public $onlyAccountCredit = false;
    public $entity = '';
    public $entityId = '';

    protected $listeners = ['payment-method-update' => 'paymentMethodUpdated'];
    
    private $taxable = false;

    public function mount()
    {

        $this->taxRate = (float) setting('tax');
        if ($this->method != 'credit') {
            $this->taxable = true;
        }

        $this->setTotalAmount();

    }

    public function paymentMethodUpdated($method)
    {
        $this->taxable = $method != 'credit';
        $this->setTotalAmount();
    }

    public function render()
    {
        return view('livewire.payment.form');
    }

    private function setTotalAmount()
    {

        if($this->taxable) {
            $this->tax = $this->amount * ($this->taxRate / 100);
        }else{
            $this->tax = 0;
        }

        $this->totalAmount = $this->amount + $this->tax;
    }
}
