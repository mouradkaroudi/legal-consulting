<?php

namespace App\Filament\Resources\DigitalOfficeResource\Pages;

use App\Filament\Resources\DigitalOfficeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDigitalOffices extends ListRecords
{
    protected static string $resource = DigitalOfficeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
