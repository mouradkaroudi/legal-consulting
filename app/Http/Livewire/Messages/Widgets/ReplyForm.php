<?php

namespace App\Http\Livewire\Messages\Widgets;

use App\Models\Message;
use App\Models\Thread;
use Filament\Forms\Components\Actions\Modal\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\HasFormComponentActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Filament\Forms\Components;

class ReplyForm extends Component implements HasForms
{

    use InteractsWithForms;
    
    public $threadId;
    public $message;
    public $attachment;

    protected function getReplyFormSchema(): array {

        return [
            Components\Textarea::make('message')
            ->extraAttributes([
                'class' => 'p-4 w-full bg-white border-0 focus:ring-0'
            ])
            ->label('')
            ->required(),
        ];

    }

    protected function getUploadFormSchema(): array {
        return [
            Components\FileUpload::make('attachment')
        ];
    }

    protected function getForms(): array
    {
        return [
            'uploadForm' => $this->makeForm()->schema($this->getUploadFormSchema()),
            'replyForm' => $this->makeForm()->schema($this->getReplyFormSchema())
        ];
    }

    public function submit() {
        $data = $this->form->getState();

        $thread = Thread::find($this->threadId);
        $body = $data['message'];

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $body,
        ]);

        return redirect(url()->previous());
    }

    public function render()
    {
        return view('livewire.messages.widgets.reply-form');
    }
}
