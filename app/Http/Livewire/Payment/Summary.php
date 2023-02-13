<?php

namespace App\Http\Livewire\Payment;

use Livewire\Component;

class Summary extends Component
{
    
    public $totalAmount = 0;
    public $taxAmount = 0;
    public $amount = 0;

    public function render()
    {
        return view('livewire.payment.summary');
    }
}
