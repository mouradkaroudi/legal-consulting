<?php

namespace App\FilamentDigitalOffice\Resources\DigitalOfficeResource\Pages;

use App\FilamentDigitalOffice\Resources\DigitalOfficeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDigitalOffice extends EditRecord
{
    protected static string $resource = DigitalOfficeResource::class;

    public function __construct()
    {
        $this->data = [
            'name' => 'test'
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
