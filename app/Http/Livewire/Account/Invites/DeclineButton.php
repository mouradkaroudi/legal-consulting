<?php

namespace App\Http\Livewire\Account\Invites;

use Livewire\Component;

class DeclineButton extends Component
{

    public function decline() {
        
    }

    public function render()
    {
        return view('livewire.account.invites.decline-button');
    }
}
