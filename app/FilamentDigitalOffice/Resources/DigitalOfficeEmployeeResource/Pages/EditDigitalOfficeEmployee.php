<?php

namespace App\FilamentDigitalOffice\Resources\DigitalOfficeEmployeeResource\Pages;

use App\FilamentDigitalOffice\Resources\DigitalOfficeEmployeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDigitalOfficeEmployee extends EditRecord
{
    protected static string $resource = DigitalOfficeEmployeeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
