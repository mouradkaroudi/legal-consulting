<?php

namespace App\Http\Livewire\Account\Orders;

use App\Events\Account\TransactionProcessed;
use App\Models\Order;
use App\Models\Transaction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Livewire\Component;

class PaymentForm extends Component implements HasForms
{
  use InteractsWithForms;

  public $orderId;
  public $paymentMethod;

  protected function getFormSchema(): array
  {
    return [
      \Filament\Forms\Components\Radio::make("paymentMethod")
        ->label("طريقة الدفع")
        ->options([
          "balance" => "الرصيد",
        ])
        ->descriptions([
          "balance" => "دفع من الرصيد في حسابك",
        ])
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

    $order = Order::find($this->orderId);

    $data = $this->form->getState();

    $paymentMethod = $data["paymentMethod"];

    $user = Auth::user();

    if ($paymentMethod === "balance") {
      if ($order->fee > $user->available_balance) {
        $this->addError('paymentMethod', 'المعذرة رصيدك غير كافي. المرجو شحن حسابك.');
      }else{
        $txn = Transaction::create([
            'user_id' => $user->id,
            'amount' => $order->fee,
            'type' => 'credit',
            'source' => 'pay_dues',
            'status' => 'completed',
            'metadata' => json_encode([
                'orderId' => $order->id
            ])
        ]);

        TransactionProcessed::dispatch($txn);
        
        $order->status = "paid";
        $order->save();

      }
    }
  }
}