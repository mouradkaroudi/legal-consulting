<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    public function mount(): void
    {
        $this->form->fill([
            'metadata' => [
                'description' => '',
                'keywords' => ''
            ]
        ]);
    }
}
