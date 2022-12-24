<?php

namespace App\Http\Livewire\Office\Balance;

use App\Models\DigitalOffice;
use Livewire\Component;

class Overview extends Component
{

    public $office;

    public function mount(DigitalOffice $office)
    {
        $this->office = $office;
    }

    public function render()
    {
        return view('livewire.office.balance.overview');
    }
}
