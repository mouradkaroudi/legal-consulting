<?php

namespace App\Http\Livewire\Front\Components;

use App\Models\DigitalOffice;
use Livewire\Component;

class OfficeCard extends Component
{
    public $office;

    public function render()
    {
        return view('livewire.front.components.office-card');
    }
}
