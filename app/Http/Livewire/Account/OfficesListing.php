<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class OfficesListing extends Component
{
    public $offices = [];

    public function mount() {

        $user = auth()->user();

        $this->offices = $user->allOffices();

    }

    public function render()
    {
        return view('livewire.account.offices-listing');
    }
}
