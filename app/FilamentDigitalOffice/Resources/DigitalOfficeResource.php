<?php

namespace App\FilamentDigitalOffice\Resources;

use App\FilamentDigitalOffice\Resources\DigitalOfficeResource\Pages;
use App\FilamentDigitalOffice\Resources\DigitalOfficeResource\RelationManagers;
use App\Models\DigitalOffice;
use Artificertech\FilamentMultiContext\Concerns\ContextualResource;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DigitalOfficeResource extends Resource
{
    use ContextualResource;

    protected static ?string $model = DigitalOffice::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('license_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('country_code')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255),
                Forms\Components\TextInput::make('image_id'),
                Forms\Components\TextInput::make('license_attachment'),
                Forms\Components\TextInput::make('lat')
                    ->maxLength(255),
                Forms\Components\TextInput::make('lng')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('banned_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\TextColumn::make('license_number'),
                Tables\Columns\TextColumn::make('country_code'),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('image_id'),
                Tables\Columns\TextColumn::make('license_attachment'),
                Tables\Columns\TextColumn::make('lat'),
                Tables\Columns\TextColumn::make('lng'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('banned_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\EditDigitalOffice::route('/'),
            'create' => Pages\CreateDigitalOffice::route('/create'),
            'edit' => Pages\EditDigitalOffice::route('/{record}/edit'),
        ];
    }    
}
