<?php

namespace App\Http\Livewire\Messages;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\Message;
use App\Models\Participant;
use App\Models\Thread;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
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

    public function send()
    {

        $data = $this->form->getState();
        $officeId = $data['officeId'];
        $this->authorize('create', [Thread::class, DigitalOffice::find($officeId)]);

        $subject = $data['subject'];
        $body = $data['body'];

        $digitalOffice = DigitalOffice::find($officeId);
        $employees = DigitalOfficeEmployee::where('office_id', $officeId)->permission('manage-messages')->get();

        $thread = new Thread(['subject' => $subject]);

        $thread->sender()->associate(Auth::user());
        $thread->receiver()->associate($digitalOffice);

        $thread->save();

        // Message
        (new Message([
            'thread_id' => $thread->id,
            //'user_id' => Auth::id(),
            'type' => Message::TEXT,
            'body' => $body,
        ]))->model()->associate(Auth::user())->save();

        // Sender
        (new Participant([
            'thread_id' => $thread->id,
            'last_read' => Date::now(),
        ]))->model()->associate(Auth::user())->save();
        
        // Office owner
        (new Participant([
            'thread_id' => $thread->id,
        ]))->model()->associate(DigitalOfficeEmployee::where('office_id',$digitalOffice->id)
            ->where('user_id', $digitalOffice->owner->id)->first()
        )->save();

        // Add all eligible employees as participants to the thread
        foreach ($employees as $employee) {
            (new Participant([
                'thread_id' => $thread->id,
            ]))->model()->associate($employee)->save();
        }

        return redirect()->route('account.messages.show', ['id' => $thread->id]);
    }


    protected function getFormSchema(): array
    {
        return [
            Hidden::make('officeId'),
            TextInput::make('subject')
                ->label(__('Subject'))
                ->required(),
            Textarea::make('body')
                ->label(__('Message'))
                ->required()
        ];
    }

    public function render()
    {
        return view('livewire.messages.send-message');
    }
}
