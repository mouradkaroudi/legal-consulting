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

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? static::$navigationLabel ?? __('filament::resources/specializations.label.plural');
    }

    public static function getPluralModelLabel(): string
    {
        return static::$pluralModelLabel ?? static::$pluralModelLabel ?? __('filament::resources/specializations.label.plural');
    }

    public static function getModelLabel(): string
    {
        return static::$modelLabel ?? static::$modelLabel ?? __('filament::resources/specializations.label.singular');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('profession_id')
                    ->label(__('filament::resources/specializations.form.fields.profession_id.label'))
                    ->relationship('profession', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament::resources/specializations.form.fields.name.label'))
                    ->required()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str_replace(' ', '-', $state)))
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label(__('filament::resources/specializations.form.fields.slug.label'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament::resources/specializations.table.columns.name.label')),
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
