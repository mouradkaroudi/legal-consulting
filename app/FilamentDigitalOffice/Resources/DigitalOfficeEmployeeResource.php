<?php

namespace App\FilamentDigitalOffice\Resources;

use App\FilamentDigitalOffice\Resources\DigitalOfficeEmployeeResource\Pages;
use App\FilamentDigitalOffice\Resources\DigitalOfficeEmployeeResource\RelationManagers;
use App\Models\DigitalOfficeEmployee;
use Artificertech\FilamentMultiContext\Concerns\ContextualResource;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DigitalOfficeEmployeeResource extends Resource
{
    use ContextualResource;

    protected static ?string $model = DigitalOfficeEmployee::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function getEloquentQuery(): Builder
    {
        return static::$model::query()->currentUserOffice()->with('user');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('role_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('national_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('degree')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nationality')
                    ->maxLength(255),
                Forms\Components\TextInput::make('gender'),
                Forms\Components\TextInput::make('profile_picture_id'),
                Forms\Components\TextInput::make('national_id_attachment')
                    ->maxLength(255)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('role_name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDigitalOfficeEmployees::route('/'),
            'create' => Pages\CreateDigitalOfficeEmployee::route('/create'),
            'edit' => Pages\EditDigitalOfficeEmployee::route('/{record}/edit'),
        ];
    }
}
