<?php

namespace App\Filament\Resources\ServiceResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProfessionsRelationManager extends RelationManager
{
	protected static string $relationship = "professions";

	protected static ?string $recordTitleAttribute = "name";
    protected static ?string $modelLabel = 'مهنة';
    protected static ?string $title = 'المهن';

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
			->columns([Tables\Columns\TextColumn::make("name")->label('الإسم')])
			->filters([
				//
			])
			->headerActions([Tables\Actions\CreateAction::make()])
			->actions([
				Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
			])
			->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
	}

	protected function mutateFormDataBeforeSave(array $data): array
	{
		return $data;
	}
}
