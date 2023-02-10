<?php

namespace App\Http\Livewire\Office\Subscription;

use App\Models\ProfessionSubscriptionPlan;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;

class Form extends Component implements HasForms
{

    use InteractsWithForms;

    public $digitalOffice;
    public $paymentMethod;
    public $plan_id;
    public $agree;

    public function mount() {
        $this->digitalOffice = auth()->user()->currentOffice;
    }

    public function submit() {
        $params = ['plan_id' => $this->plan_id];
        $paymentMethod = $this->paymentMethod;

        if($paymentMethod === 'accountBalance') {
            $params['from'] = 'account';
        }

        if(in_array($paymentMethod, ['accountBalance', 'officeBalance'])) {
            $paymentMethod = 'balance';
        }

        return redirect()->route('payment.paypal.checkout', ['entity' => 'plan', 'id' => $this->plan_id]);  
    }

    protected function getFormSchema(): array
    {

        $plans = ProfessionSubscriptionPlan::where('profession_id', $this->digitalOffice->profession_id)->get();

        return [
            RadioButton::make('plan_id')->options(function() use ($plans) {
                return $plans->pluck('fee_label', 'id');
            })->descriptions(function() use ($plans) {
                return $plans->pluck('name', 'id');
            })->label(false)->required(),
            RadioButton::make("paymentMethod")
            ->label(__('Payment method'))
            ->options([
                "accountBalance" => __('Account balance'),
                "officeBalance" => __('Office balance'),
                "paypal" => __('PayPal'),
                "bank-transfer" => __('Bank transfer'),
            ])
            ->columns(1)
            ->required(),

            Checkbox::make('agree')->label('أوافق على شروط إستخدام الموقع.')->required()
        ];
    }

    public function render()
    {
        return view('livewire.office.subscription.form');
    }
}
