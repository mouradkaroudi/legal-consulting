<?php

namespace App\Http\Livewire\Pages\Auth;

use Livewire\Component;

class ResetPassword extends Component
{

    //TODO: add $email, $token from $request

    public $email;
    public $token;

    public function render()
    {
        return view('livewire.pages.auth.reset-password')->layout('layouts.guest');
    }
}
