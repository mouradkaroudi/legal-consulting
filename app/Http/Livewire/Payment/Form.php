<?php

namespace App\Http\Livewire\Payment;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class Form extends Component implements HasForms
{

    use InteractsWithForms;

    public $paymentMethod;
    public $type;
    public $params = [];

    protected function getFormSchema(): array
    {
        return [
            RadioButton::make("paymentMethod")
                ->label("وصيلة الدفع")
                ->options([
                    "balance" => "الرصيد",
                    "paypal" => "بايبال",
                    "bank_transfer" => "تحويل بنكي",
                ])
                ->descriptions([
                    "balance" => "الدفع من الرصيد المتوفر في حسابك",
                    "paypal" => "الدفع من خلال حسابك على باببال",
                ])
                ->columns(2)
                ->required(),
        ];
    }

    public function submit()
    {
        return redirect()->route('payment.' . $this->paymentMethod . '.' . $this->type, ['params' => $this->params]);
    }

    public function render()
    {
        return view('livewire.payment.form');
    }
}
