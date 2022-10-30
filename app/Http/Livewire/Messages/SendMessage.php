<?php

namespace App\Http\Livewire\Messages;

use App\Models\DigitalOffice;
use App\Models\Message;
use App\Models\Participant;
use App\Models\Thread;
use Carbon\Carbon;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SendMessage extends Component implements HasForms
{

    use InteractsWithForms, AuthorizesRequests;
    public $officeId = 0;
    public $subject = "";
    public $body = "";

    public function mount(): void 
    {
        $this->form->fill([
            'officeId' => $this->officeId,
        ]);
    }

    public function send() {

        $data = $this->form->getState();
        $officeId = $data['officeId'];
        $this->authorize('create', [Thread::class, DigitalOffice::find($officeId)]);


        $subject = $data['subject'];
        $body = $data['body'];

        $thread = Thread::create([
            'user_id' => Auth::id(),
            'office_id' => $officeId,
            'subject' => $subject,
        ]);

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $body,
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon(),
        ]);

        return redirect()->route('messages');
    }
    

    protected function getFormSchema(): array
    {
        return [
            Hidden::make('officeId'),
            TextInput::make('subject')->label('الموضوع')->required(),
            Textarea::make('body')->label('الرسالة')->required()
        ];
    }

    public function render()
    {
        return view('livewire.messages.send-message');
    }
}
