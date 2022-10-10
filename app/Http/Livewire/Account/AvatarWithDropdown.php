<?php

namespace App\Http\Livewire\Account;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AvatarWithDropdown extends Component
{

    public $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.account.avatar-with-dropdown');
    }
    
    
}   

