<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpecializationResource\Pages;
use App\Filament\Resources\SpecializationResource\RelationManagers;
use App\Models\Specialization;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpecializationResource extends Resource
{
    protected static ?string $model = Specialization::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Entities';
    protected static ?string $navigationLabel = 'التخصصات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('profession_id')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str_replace(' ', '-', $state)))
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
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
            'index' => Pages\ListSpecializations::route('/'),
            'create' => Pages\CreateSpecialization::route('/create'),
            'edit' => Pages\EditSpecialization::route('/{record}/edit'),
        ];
    }    
}
