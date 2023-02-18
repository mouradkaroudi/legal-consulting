<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Card::make([
                Forms\Components\Grid::make()->schema([
                    Forms\Components\TextInput::make('name')->inlineLabel(),
                    Forms\Components\TextInput::make('email')->inlineLabel(),
                    Forms\Components\TextInput::make('ID_number')->inlineLabel(),
                    Forms\Components\TextInput::make('phone_number')->inlineLabel(),
                    Forms\Components\TextInput::make('country_id')->inlineLabel(),
                    Forms\Components\TextInput::make('ID_image')->inlineLabel(),
                    Forms\Components\TextInput::make('driving_license_image')->inlineLabel(),
                    Forms\Components\TextInput::make('preferred_lang')->inlineLabel(),
                    Forms\Components\TextInput::make('address')->inlineLabel(),
                ])
            ])->label('dsd')
        ];
    }
}
