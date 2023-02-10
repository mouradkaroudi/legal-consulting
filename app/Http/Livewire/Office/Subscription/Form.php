<?php

namespace App\Http\Livewire\Office\Subscription;

use App\Models\ProfessionSubscriptionPlan;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;

class Form extends Component implements HasForms
{

    use InteractsWithForms;

    public $digitalOffice;
    public $paymentMethod;
    public $plan_id;
    public $agree;

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
                ->columns(4)
                ->required()
        ];
    }

    protected function getPaymentAccountOptionsFormSchema(): array {
        return [
            RadioButton::make("paymentMethod")
                ->label('')
                ->options([
                    "accountBalance" => __('Account balance'),
                    "officeBalance" => __('Office balance')
                ])
                ->descriptions([
                    "accountBalance" => __('The payment will be taken from your account credit'),
                    "officeBalance" => __('The payment will be taken from your the office credit')
                ])
                ->columns(2)
                ->required(),
        ];
    }

    protected function getForms(): array
	{
		return [
			"plansForm" => $this->makeForm()->schema($this->getPlansFormSchema()),
			"paymentAccountOptionsForm" => $this->makeForm()->schema(
				$this->getPaymentAccountOptionsFormSchema()
			),
		];
	}

    public function render()
    {
        return view('livewire.office.subscription.form');
    }
}
