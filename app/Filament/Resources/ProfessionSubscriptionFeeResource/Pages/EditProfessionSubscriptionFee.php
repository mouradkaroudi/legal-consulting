<?php

namespace App\Filament\Resources\ProfessionSubscriptionFeeResource\Pages;

use App\Filament\Resources\ProfessionSubscriptionFeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfessionSubscriptionFee extends EditRecord
{
    protected static string $resource = ProfessionSubscriptionFeeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
