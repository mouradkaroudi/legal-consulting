<?php

namespace App\Filament\Resources\OrdersResource\Pages;

use App\Filament\Resources\OrdersResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOrders extends ManageRecords
{
    protected static string $resource = OrdersResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
