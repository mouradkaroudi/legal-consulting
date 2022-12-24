<?php

namespace App\Http\Livewire\Messages;

use App\Models\Thread;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class CloseThread extends Component
{

    use AuthorizesRequests;

    public $thread;

    public function mount( Thread $thread ) {
        $this->thread = $thread;
    }

    public function close() {

        //$this->authorize('update', $this->thread);

        $this->thread->closed_at = Date::now();
        $this->thread->closed_by = auth()->user()->id;

        $this->thread->save();

        return redirect()->route('account.messages.show', ['id' => $this->thread->id]);

    }

    public function render()
    {
        return view('livewire.messages.close-thread');
    }
}
