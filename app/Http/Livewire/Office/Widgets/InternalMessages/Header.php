<?php

namespace App\Http\Livewire\Office\Widgets\InternalMessages;

use Livewire\Component;

class Header extends Component
{
    public $thread = null;
    public $showCreateOffer = false;
    public $showCloseConversation = false;

    public function render()
    {
        return view('livewire.office.widgets.internal-messages.header');
    }
}
