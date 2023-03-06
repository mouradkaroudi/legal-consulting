<?php

namespace App\Http\Livewire\Account\Widgets\Messages;

use Livewire\Component;

class Header extends Component
{
    public $thread = null;
    public $showCreateOffer = false;
    public $showCloseConversation = false;

    public function render()
    {
        return view('livewire.account.widgets.messages.header');
    }
}
