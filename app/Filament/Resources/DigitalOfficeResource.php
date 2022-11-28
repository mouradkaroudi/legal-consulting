<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DigitalOfficeResource\Pages;
use App\Filament\Resources\DigitalOfficeResource\RelationManagers;
use App\Models\DigitalOffice;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DigitalOfficeResource extends Resource
{
    protected static ?string $model = DigitalOffice::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('service_id'),
                Forms\Components\TextInput::make('profession_id'),
                Forms\Components\TextInput::make('user_id')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description'),
                Forms\Components\TextInput::make('image')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('professional_license_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('country_code')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255),
                Forms\Components\TextInput::make('license_attachment'),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('banned_at'),
                Forms\Components\Textarea::make('location'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service_id'),
                Tables\Columns\TextColumn::make('profession_id'),
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('image'),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\TextColumn::make('professional_license_number'),
                Tables\Columns\TextColumn::make('country_code'),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('license_attachment'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('banned_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('location'),
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
            'index' => Pages\ListDigitalOffices::route('/'),
            'create' => Pages\CreateDigitalOffice::route('/create'),
            'edit' => Pages\EditDigitalOffice::route('/{record}/edit'),
        ];
    }    
}
