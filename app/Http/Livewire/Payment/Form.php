<?php

namespace App\Http\Livewire\Payment;

use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Suleymanozev\FilamentRadioButtonField\Forms\Components\RadioButton;

class Form extends Component
{
    
    public $amount = 0;
    public $totalAmount = 0;
    public $taxAmount = 0;

    public function render()
    {
        return view('livewire.payment.form');
    }
}
