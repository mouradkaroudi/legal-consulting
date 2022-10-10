<?php

namespace App\FilamentDigitalOffice\Resources\DigitalOfficeEmployeeResource\Pages;

use App\FilamentDigitalOffice\Resources\DigitalOfficeEmployeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDigitalOfficeEmployees extends ListRecords
{
    protected static string $resource = DigitalOfficeEmployeeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
