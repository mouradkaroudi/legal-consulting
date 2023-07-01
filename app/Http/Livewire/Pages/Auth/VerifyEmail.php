<?php

namespace App\Http\Livewire\Pages\Auth;

use Livewire\Component;

class VerifyEmail extends Component
{
    public function render()
    {
        return view('livewire.pages.auth.verify-email')->layout('layouts.guest');
    }
}
