<?php

namespace App\Http\Livewire\Pages\Auth;

use Livewire\Component;

class Login extends Component
{

    public $redirect = null;

    public function render()
    {
        return view('livewire.pages.auth.login')->layout('layouts.guest');
    }
}
