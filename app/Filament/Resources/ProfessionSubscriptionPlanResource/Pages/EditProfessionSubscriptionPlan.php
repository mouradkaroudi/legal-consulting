<?php

namespace App\Filament\Resources\ProfessionSubscriptionPlanResource\Pages;

use App\Filament\Resources\ProfessionSubscriptionPlanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfessionSubscriptionPlan extends EditRecord
{
    protected static string $resource = ProfessionSubscriptionPlanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
