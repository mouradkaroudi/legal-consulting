<?php

namespace App\Filament\Resources\ProfessionResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpecializationsRelationManager extends RelationManager
{
    protected static string $relationship = 'specializations';

    protected static ?string $recordTitleAttribute = 'profession_id';
    protected static ?string $modelLabel = 'تخصص';
    protected static ?string $title = 'التخصصات';

    public static function form(Form $form): Form
    {
		return $form->schema([
			Forms\Components\TextInput::make("name")
				->required()
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str_replace(' ', '-', $state)))
                ->label('الإسم')
				->maxLength(255),
			Forms\Components\TextInput::make("slug")
				->required()
                ->label('الاسم اللطيف')
				->maxLength(255),
		]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('الإسم'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
