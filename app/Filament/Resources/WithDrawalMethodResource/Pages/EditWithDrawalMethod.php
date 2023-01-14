<?php

namespace App\Filament\Resources\WithDrawalMethodResource\Pages;

use App\Filament\Resources\WithDrawalMethodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWithDrawalMethod extends EditRecord
{
    protected static string $resource = WithDrawalMethodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
