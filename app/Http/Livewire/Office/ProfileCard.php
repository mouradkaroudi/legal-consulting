<?php

namespace App\Http\Livewire\Office;

use Livewire\Component;

class ProfileCard extends Component
{
    public $office;

    public function render()
    {
        return view('livewire.office.profile-card');
    }
}
