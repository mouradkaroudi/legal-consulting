<?php

namespace App\Http\Livewire\Account\Orders;

use App\Events\Account\TransactionProcessed;
use App\Models\DigitalOffice;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;

class PaymentForm extends Component implements HasForms
{
	use InteractsWithForms;

	public $orderId;
	public $paymentMethod;

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

	public function render()
	{
		return view("livewire.account.orders.payment-form");
	}

	public function submit()
	{
		if (empty($this->orderId)) {
			return;
		}

		$user = Auth::user();
		$order = Order::find($this->orderId);

		$data = $this->form->getState();

		$paymentMethod = $data["paymentMethod"];

		if ($paymentMethod === "balance") {
			if ($order->fee > $user->available_balance) {
				$this->addError(
					"paymentMethod",
					"المعذرة رصيدك غير كافي. المرجو شحن حسابك."
				);
			} else {
				$this->orderPaid($order, $user);
			}
		}
	}

	private function orderPaid($order, User $user)
	{
		$office = DigitalOffice::find($order->office_id);

		$user->transactions()->create([
			"amount" => $order->fee,
			"type" => "credit",
			"source" => "pay_dues",
			"status" => "completed",
			"metadata" => json_encode([
				"orderId" => $order->id,
			]),
		]);

		$office->transactions()->create([
			"amount" => $order->fee,
			"type" => "debit",
			"source" => "recieve_earnings",
			"status" => "completed",
			"metadata" => json_encode([
				"orderId" => $order->id,
			]),
		]);

		// TODO: send notification for every successfull transaction
		$order->status = "paid";
		$order->save();
	}
}
