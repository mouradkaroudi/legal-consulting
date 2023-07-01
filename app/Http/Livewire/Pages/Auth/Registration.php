<?php

namespace App\Http\Livewire\Pages\Auth;

use Livewire\Component;

class Registration extends Component
{
    public $invite;

    public function render()
    {
        return view('livewire.pages.auth.registration')->layout('layouts.guest');
    }
}
