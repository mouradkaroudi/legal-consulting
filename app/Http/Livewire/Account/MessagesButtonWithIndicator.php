<?php

namespace App\Http\Livewire\Account;

use App\Models\Message;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MessagesButtonWithIndicator extends Component
{

    public $messagesCount = 0;

    public function mount() {

        $user = Auth::user();
        $this->messagesCount = Message::unreadForUser($user->id)->count();

    }

    public function render()
    {
        return view('livewire.account.messages-button-with-indicator');
    }
}
