<?php

namespace App\Http\Livewire\Office;

use App\Models\DigitalOffice;
use Livewire\Component;

class OfficeDropdown extends Component
{

    public $currentOffice = [];

    public function mount()
    {
        $this->currentOffice = auth()->user()->currentOffice;
    }
    
    public function render()
    {
        return view('livewire.office.office-dropdown');
    }
}
