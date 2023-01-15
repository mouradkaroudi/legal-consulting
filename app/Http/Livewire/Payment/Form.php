<?php

namespace App\Http\Livewire\Payment;

use App\Models\ProfessionSubscriptionPlan;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class Form extends Component implements HasForms
{

    use InteractsWithForms;

    public $paymentMethod;
    public $professionSubscriptionPlan;

    protected function getFormSchema(): array
    {
        return [
            RadioButton::make("paymentMethod")
                ->label("وصيلة الدفع")
                ->options([
                    "balance" => "الرصيد",
                    "paypal" => "بايبال",
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

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('office.subscription.subscribe', ['plan_id' => $this->professionSubscriptionPlan->id]),
                "cancel_url" => route('office.subscription.index'),
            ],
            "purchase_units" => [
                0 => [
                    "custom_id" => 100,
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $this->professionSubscriptionPlan->fee
                    ]
                ]
            ]
        ]);
        
        // redirect to approve href
        foreach ($order['links'] as $links) {
            if ($links['rel'] == 'approve') {
                return redirect()->away($links['href']);
            }
        }
    }

    public function render()
    {
        return view('livewire.payment.form');
    }
}
