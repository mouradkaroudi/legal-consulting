<?php

namespace App\Http\Livewire\Payment\Gateways\Paypal;

use Livewire\Component;

class Form extends Component 
{

    public function submit() {
        redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.payment.gateways.paypal.form');
    }
}
