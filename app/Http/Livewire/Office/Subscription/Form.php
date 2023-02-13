<?php

namespace App\Http\Livewire\Office\Subscription;

use App\Models\ProfessionSubscriptionPlan;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;

class Form extends Component implements HasForms
{

    use InteractsWithForms;

    public $digitalOffice;
    public $paymentMethod;
    public $plan_id;
    public $agree;
    public $credit;

    public function mount()
    {
        $this->digitalOffice = auth()->user()->currentOffice;
    }

    public function submit()
    {
        $params = ['plan_id' => $this->plan_id];
        $paymentMethod = $this->paymentMethod;

        if ($paymentMethod === 'accountBalance') {
            $params['from'] = 'account';
        }

        if (in_array($paymentMethod, ['accountBalance', 'officeBalance'])) {
            $paymentMethod = 'balance';
        }

        return redirect()->route('payment.paypal.checkout', ['entity' => 'plan', 'id' => $this->plan_id]);
    }

    protected function getPlansFormSchema(): array
    {
        $plans = ProfessionSubscriptionPlan::where('profession_id', $this->digitalOffice->profession_id)->get();
        return [
            RadioButton::make('plan_id')
                ->label(__('Choose the right plan for you'))
                ->reactive()
                ->options(function () use ($plans) {
                    return $plans->pluck('fee_label', 'id');
                })
                ->descriptions(function () use ($plans) {
                    return $plans->pluck('name', 'id');
                })
                ->columns(2)
                ->required()
        ];
    }

    protected function getPaymentAccountOptionsFormSchema(): array
    {
        return [
            Section::make(__('Bank transfer'))
            ->schema([
                View::make('livewire.payment.bank-transfer-form')->schema([
                    TextInput::make('test')
                ])
            ])
            ->collapsible()
            ,
            Section::make(__('Pay from balance'))
                ->schema([
                    RadioButton::make("credit")
                        ->label('')
                        ->options([
                            "account" => __('Account balance'),
                            "office" => __('Office balance')
                        ])
                        ->descriptions([
                            "account" => __('The payment will be taken from your account credit'),
                            "office" => __('The payment will be taken from your the office credit')
                        ])
                        ->columns(1)
                        ->required(),
                ])->collapsible()
        ];
    }

    protected function getPaymentFormSchema(): array
    {
        return [

            Section::make(__('Make a deposit'))
                ->schema([
                    RadioButton::make("paymentMethod")
                        ->label(__('Choose a payment method'))
                        ->options([
                            "paypal" => __('PayPal'),
                            "bank-transfer" => __('Bank transfer'),
                        ])
                        ->descriptions([
                            'paypal' => __("You'll be redirected to PayPal website to complete your purchase securely")
                        ])
                ])
                ->collapsible()
                ->collapsed()
        ];
    }

    protected function getForms(): array
    {
        return [
            "plansForm" => $this->makeForm()->schema($this->getPlansFormSchema()),
            "paymentAccountOptionsForm" => $this->makeForm()->schema(
                $this->getPaymentAccountOptionsFormSchema()
            ),
            'paymentForm' => $this->makeForm()->schema(
                $this->getPaymentFormSchema()
            )
        ];
    }

    public function render()
    {
        return view('livewire.office.subscription.form');
    }
}
