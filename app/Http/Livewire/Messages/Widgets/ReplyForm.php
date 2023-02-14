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
use Illuminate\Support\Str;

class ReplyForm extends Component implements HasForms
{

    use InteractsWithForms;
    
    public $thread;
    public $message;
    public $attachment;
    public $displayUpload = false;

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
                ->label(__('Attachment'))
                ->hint(__('Only documents and images are allowed. Max file size :maxsize Mo', ['maxsize' => 24]))
                ->directory('attachments')
                ->acceptedFileTypes([
                    'image/*', 
                    'application/pdf', 
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-powerpoint',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/zip',
                    'application/vnd.rar',
                ])
                ->maxSize(12000)
        ];
    }

    public function upload($file) {
        //dd($file);
    }

    protected function getForms(): array
    {
        return [
            'uploadForm' => $this->makeForm()->schema($this->getUploadFormSchema()),
            'replyForm' => $this->makeForm()->schema($this->getReplyFormSchema())
        ];
    }

    public function submit() {

        $body = $this->message;

        $data = $this->uploadForm->getState();

        if(!empty($this->attachment)) {
            Message::create([
                'thread_id' => $this->thread->id,
                'user_id' => Auth::id(),
                'body' => $data['attachment'],
                'type' => 'attachment'    
            ]);
        }

        // Message
        Message::create([
            'thread_id' => $this->thread->id,
            'user_id' => Auth::id(),
            'body' => $body,
            'type' => 'text'
        ]);

        return redirect(url()->previous());
    }

    public function render()
    {
        return view('livewire.messages.widgets.reply-form');
    }
}
