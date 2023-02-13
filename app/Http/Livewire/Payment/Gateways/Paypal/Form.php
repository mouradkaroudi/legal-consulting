<?php

namespace App\Http\Livewire\Payment\Gateways\Paypal;

use Livewire\Component;

class Form extends Component
{

    public $entity;
    public $entityId;

    public function submit()
    {

        $url = route('payment.paypal.checkout', ['entity' => $this->entity, 'id' => $this->entityId]);
        
        return redirect($url);
    }

    public function render()
    {
        return view('livewire.payment.gateways.paypal.form');
    }
}
