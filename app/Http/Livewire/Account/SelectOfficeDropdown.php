<?php

namespace App\Http\Livewire\Account;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SelectOfficeDropdown extends Component
{
    public $offices = [];
    public $ownedOffices = [];

    public function mount()
    {
        $this->ownedOffices = Auth::user()->ownedOffices;
        $this->offices = Auth::user()->allOffices();
    }

    public function render()
    {

        return view('livewire.account.select-office-dropdown');
    }
}
