<?php

namespace App\Http\Livewire\Office;

use Livewire\Component;

class SendMessageButton extends Component
{
    
    public $is_logged_in = false;

    public function __construct()
    {
        $this->is_logged_in = !empty(auth()->user());
    }

    public function render()
    {
        return view('livewire.office.send-message-button', ['is_logged_in' => $this->is_logged_in]);
    }
}
