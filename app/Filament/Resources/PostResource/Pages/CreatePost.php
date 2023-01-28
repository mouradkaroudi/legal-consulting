<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    public function mount(): void
    {
        $this->form->fill([
            'metadata' => [
                'description' => '' 
            ]
        ]);
    }

}
