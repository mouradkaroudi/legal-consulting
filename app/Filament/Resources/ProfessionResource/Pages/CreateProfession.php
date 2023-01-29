<?php

namespace App\Filament\Resources\ProfessionResource\Pages;

use App\Filament\Resources\ProfessionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfession extends CreateRecord
{
    protected static string $resource = ProfessionResource::class;

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
