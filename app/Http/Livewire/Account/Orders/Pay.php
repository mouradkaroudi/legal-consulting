<?php

namespace App\Http\Livewire\Account\Orders;

use App\Models\Order;
use App\Models\Transaction;
use App\Services\OrderService;
use App\Services\TransactionService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

use Filament\Forms;

class Pay extends Component implements HasForms
{

    use InteractsWithForms;

    public Order $order;
    public $totalAmount;
    public $applyTax = false;
    public $taxRate = 0;
    public $taxAmount = 0;

    public $isBalancePaymentSelected = true;

    protected $listeners = ['payment-method-update' => 'paymentMethodUpdated'];

    public function mount() {
        $this->taxRate = (float) setting('tax');

        if (!$this->isBalancePaymentSelected) {
            $this->applyTax = true;
        }

        $this->setTotalAmount();

        $this->form->fill([
            'order_id' => $this->order->id
        ]);
    }

    public function paymentMethodUpdated() {
        $this->isBalancePaymentSelected = false;
        $this->applyTax = true;
        $this->setTotalAmount();
        $this->form->fill([
            'balance' => null,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Hidden::make('order_id')
        ];
    }

    public function render()
    {
        return view('livewire.account.orders.pay');
    }

    public function submit()
    {

        try {
            $txn = TransactionService::pay(
                request()->user(),
                $this->order->office,
                [
                    'amount' => $this->order->amount,
                    'status' => Transaction::SUCCESS,
                    'metadata' => ['order_id' => $this->order->id]
                ]
            );

            OrderService::markAsPaid($this->order);
        } catch (\Throwable $th) {
            $this->addError('order_id', $th->getMessage());
        }
    }

    private function setTotalAmount()
    {

        if($this->applyTax) {
            $this->taxAmount = $this->order->amount * ($this->taxRate / 100);
        }else{
            $this->taxAmount = 0;
        }

        $this->totalAmount = $this->order->amount + $this->taxAmount;
    }

}
