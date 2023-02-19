<?php

namespace App\Filament\Resources\WithDrawalMethodResource\Pages;

use App\Filament\Resources\WithDrawalMethodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWithDrawalMethod extends CreateRecord
{

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['fees'] = [
            'min_fee' => $data['min_fee'],
            'max_fee' => $data['max_fee'],
            'percentage_fee' => $data['percentage_fee']
        ];

        unset($data['min_fee']);
        unset($data['max_fee']);
        unset($data['percentage_fee']);

        return $data;

    }

    protected static string $resource = WithDrawalMethodResource::class;
}
