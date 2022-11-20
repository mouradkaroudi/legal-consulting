<?php

namespace App\Filament\Resources\DigitalOfficeResource\Pages;

use App\Filament\Resources\DigitalOfficeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDigitalOffice extends EditRecord
{
    protected static string $resource = DigitalOfficeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
