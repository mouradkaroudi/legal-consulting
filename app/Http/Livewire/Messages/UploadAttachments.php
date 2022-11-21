<?php

namespace App\Http\Livewire\Messages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

use Filament\Forms\Components;

class UploadAttachments extends Component implements HasForms
{

    use InteractsWithForms;

    public $attachment;

    protected function getFormSchema(): array
    {
        return [
            Components\FileUpload::make('attachment')
        ];
    }

    public function render()
    {
        return view('livewire.messages.upload-attachments');
    }
}
