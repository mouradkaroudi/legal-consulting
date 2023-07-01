<?php

namespace App\Http\Livewire\Pages\Auth;

use Livewire\Component;

class ForgetPassword extends Component
{
    public $email;
    public $token;

    public function render()
    {
        return view('livewire.pages.auth.forget-password')->layout('layouts.guest');
    }
}
