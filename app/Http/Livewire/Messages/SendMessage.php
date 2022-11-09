<?php

namespace App\Http\Livewire\Messages;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
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

        $digitalOffice = DigitalOffice::find($officeId);
        $employees = DigitalOfficeEmployee::where('office_id', $officeId)->permission('manage-messages')->get();
        
        $thread = Thread::create([
            'user_id' => Auth::id(),
            'office_id' => $digitalOffice->id,
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

        // Office owner
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => $digitalOffice->user_id
        ]);

        // Add all eligible employees as participants to the thread
        foreach($employees as $employee) {
            Participant::create([
                'thread_id' => $thread->id,
                'user_id' => $employee->user_id
            ]);
        }

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
