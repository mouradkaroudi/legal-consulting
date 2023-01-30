<?php

namespace App\Http\Livewire\Account\Payment\Order;

use Livewire\Component;
use Filament\Forms;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;

class Form extends Component implements Forms\Contracts\HasForms
{

    use Forms\Concerns\InteractsWithForms;

    public $paymentMethod;
    public $agree;

    public function submit() {
		$data = $this->mountedTableActionData;
		$orderId = $data["orderId"];
		
		$params = ['order_id', $orderId];

		return redirect()->route('payment.' . $this->paymentMethod . '.order', ['params' => $params]);
    }

    protected function getFormSchema(): array
    {

        return [
            RadioButton::make("paymentMethod")
            ->label(__('Payment method'))
            ->options([
                "balance" => __('Balance'),
                "paypal" => __('PayPal'),
                "bank-transfer" => __('Bank transfer'),
            ])
            ->descriptions([
            ])
            ->columns(1)
            ->required(),
            Forms\Components\Checkbox::make('agree')->label('أوافق على شروط إستخدام الموقع.')->required()
        ];
    }

    public function render()
    {
        return view('livewire.account.payment.order.form');
    }
}
