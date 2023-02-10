<?php

namespace App\Http\Livewire\Payment;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;

class Form extends Component implements HasForms
{

    use InteractsWithForms;

    public $amount = 0;
    public $taxAmount = 0;
    public $totalAmount = 0;
    public $fees = 0;
    public $actual_amount = 0;
    public $plan_id;
    protected function getFormSchema(): array
    {
        return [
            RadioButton::make("paymentMethod")
            ->label(__('Choose a payment method'))
            ->options([
                "paypal" => __('PayPal'),
                "bank-transfer" => __('Bank transfer'),
            ])
            ->descriptions([
                'paypal' => __("You'll be redirected to PayPal website to complete your purchase securely")
            ])
        ];
    }

    public function render()
    {
        return view('livewire.payment.form');
    }
}
