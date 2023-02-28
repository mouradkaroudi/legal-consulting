<?php

namespace App\Http\Livewire\Payment\Gateways\StcPay;

use Livewire\Component;

class Form extends Component
{
    public $entity;
    public $entityId;

    public function submit()
    {
    }

    public function render()
    {
        return view('livewire.payment.gateways.stc-pay.form');
    }
}
