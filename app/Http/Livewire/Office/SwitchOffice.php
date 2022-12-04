<?php

namespace App\Http\Livewire\Office;

use App\Models\DigitalOffice;
use Livewire\Component;

class SwitchOffice extends Component
{

    public $offices = [];
    public $ownedOffices = [];
    public $currentOffice = [];
    public $hasManyOffices = false;

    public function mount()
    {
        $this->currentOffice = auth()->user()->currentOffice;
        $this->ownedOffices = auth()->user()->ownedOffices->where('id', '!=', $this->currentOffice->id);
        $this->offices = auth()->user()->offices->where('id', '!=', $this->currentOffice->id);

        $this->hasManyOffices = !empty($this->offices) || !empty($this->ownedOffices);

    }
    public function render()
    {
        return view('livewire.office.switch-office');
    }
}
