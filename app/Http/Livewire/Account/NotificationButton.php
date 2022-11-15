<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class NotificationButton extends Component
{
    public $notificationsCount;

    public function mount() {

        $user = auth()->user();

        $this->notificationsCount = $user->unreadNotifications->count();

    }

    public function render()
    {
        return view('livewire.account.notification-button');
    }
}
