<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionResource\Pages;
use App\Filament\Resources\ProfessionResource\RelationManagers;
use App\Models\Profession;
use App\Models\Service;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfessionResource extends Resource
{
    protected static ?string $model = Profession::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Entities';
    protected static ?string $navigationLabel = 'المهن';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_id')->options(function() {
                    return Service::all()->pluck('name', 'id');
                })->label('اختر الخدمة')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str_replace(' ', '-', $state)))
                    ->label('الإسم')
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->label('الإسم اللطيف')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
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
            RelationManagers\SpecializationsRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfessions::route('/'),
            'create' => Pages\CreateProfession::route('/create'),
            'edit' => Pages\EditProfession::route('/{record}/edit'),
        ];
    }    
}
