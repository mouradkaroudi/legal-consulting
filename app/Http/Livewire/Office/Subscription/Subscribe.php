<?php

namespace App\Http\Livewire\Office\Subscription;

use App\Models\DigitalOffice;
use App\Models\ProfessionSubscriptionPlan;
use App\Models\Transaction;
use App\Services\SubscriptionService;
use App\Services\TransactionService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Filament\Forms;

class Subscribe extends Component implements HasForms
{
    use InteractsWithForms;

    public $credit;
    public ProfessionSubscriptionPlan $plan;
    public $totalAmount;
    public $applyTax = false;
    public $taxRate = 0;
    public $taxAmount = 0;

    public $isBalancePaymentSelected = true;

    protected $listeners = [
        'payment-method-update' => 'paymentMethodUpdated',
        'balance-payment-selected' => 'balancePaymentSelected',
    ];

    public function mount()
    {
        $this->taxRate = (float) setting('tax');

        if (!$this->isBalancePaymentSelected) {
            $this->applyTax = true;
        }

        $this->setTotalAmount();

        $this->form->fill([
            'plan_id' => $this->plan->id
        ]);
    }

    public function balancePaymentSelected()
    {
        $this->isBalancePaymentSelected = true;
        $this->applyTax = false;
        $this->setTotalAmount();
    }

    public function paymentMethodUpdated()
    {
        $this->isBalancePaymentSelected = false;
        $this->applyTax = true;
        $this->setTotalAmount();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Radio::make('credit')
                ->label(__('Choose the account type'))
                ->options([
                    'account' => __('Account balance'),
                    'office' => __('Office balance')
                ])
                ->required()
        ];
    }

    public function render()
    {
        return view('livewire.office.subscription.subscribe');
    }

    public function submit()
    {

        $payer = $this->credit === 'account' ? auth()->user() :  auth()->user()->currentOffice;

        if (empty($payer)) {
            return response('', 400);
        }

        // FIXME: move this to Transaction service
        if ($this->totalAmount > $payer->available_balance) {
            $this->addError('balance',  __("Insufficient account balance. Please try another payment method"));
            return;
        }

        TransactionService::subscribe(
            $payer,
            [
                'amount' => $this->totalAmount,
                'status' => Transaction::SUCCESS,
                'metadata' => ['subscription_plan' => $this->plan->id]
            ]            
        );
        
        $office = auth()->user()->currentOffice;

        SubscriptionService::createSubscription(
            $office,
            $this->plan
        );

        $office->status = DigitalOffice::AVAILABLE;
        if (setting('digital_office_direct_registration') == 1) {
            
        } else {
            //$office->status = DigitalOffice::PENDING;
        }

        $office->save();

        return redirect()->route('office.settings',['tab' => 'subscription'])->with(
            'success',
            __("Congratulation! You have been subscribed")
        );
    }

    private function setTotalAmount()
    {

        if ($this->applyTax) {
            $this->taxAmount = $this->plan->amount * ($this->taxRate / 100);
        } else {
            $this->taxAmount = 0;
        }

        $this->totalAmount = $this->plan->amount + $this->taxAmount;
    }
}
