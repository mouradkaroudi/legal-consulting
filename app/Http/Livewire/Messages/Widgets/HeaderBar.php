<?php

namespace App\Http\Livewire\Messages\Widgets;

use Livewire\Component;

class HeaderBar extends Component
{

    public $thread = null;
    public $showCreateOffer = false;
    public $showCloseConversation = false;

    public function render()
    {
        return view('livewire.messages.widgets.header-bar');
    }
}
