<?php

namespace App\Http\Livewire\Messages\Widgets;

use App\Models\Message;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Filament\Forms\Components;

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
            (new Message([
                'thread_id' => $this->thread->id,
                'body' => $data['attachment'],
                'type' => Message::ATTACHMENT    
            ]))->model()->associate(Auth::user()->loggedAs())->save();
        }

        // Message
        (new Message([
            'thread_id' => $this->thread->id,
            'body' => $body,
            'type' => Message::TEXT
        ]))->model()->associate(Auth::user()->loggedAs())->save();

        return redirect(url()->previous());
    }

    public function render()
    {
        return view('livewire.messages.widgets.reply-form');
    }
}
