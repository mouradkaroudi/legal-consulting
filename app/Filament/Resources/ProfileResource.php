<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Filament\Resources\ProfileResource\RelationManagers;
use App\Models\Profile;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ProfileResource extends Resource
{
	protected static ?string $model = Profile::class;

	protected static ?string $navigationIcon = "heroicon-o-collection";

	protected static bool $shouldRegisterNavigation = false;

	protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? static::$navigationLabel ?? __('filament::resources/profiles.label.plural');
    }

    public static function getPluralModelLabel(): string
    {
        return static::$pluralModelLabel ?? static::$pluralModelLabel ?? __('filament::resources/profiles.label.plural');
    }

    public static function getModelLabel(): string
    {
        return static::$modelLabel ?? static::$modelLabel ?? __('filament::resources/profiles.label.singular');
    }

	public static function form(Form $form): Form
	{
		return $form->schema([]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				\Filament\Tables\Columns\TextColumn::make("user.name")->label(
					"اسم المستخدم"
				),
				\Filament\Tables\Columns\BadgeColumn::make("status")
					->enum([
						Profile::AVAILABLE => __("profile.available"),
						Profile::BUSY => __("profile.busy"),
						Profile::UNCOMPLETED => __("profile.uncompleted"),
					])
					->label("الحالة"),
			])
			->filters([
				//
			])
			->actions([Tables\Actions\EditAction::make()])
			->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
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
			"index" => Pages\ListProfiles::route("/"),
			"create" => Pages\CreateProfile::route("/create"),
			"edit" => Pages\EditProfile::route("/{record}/edit"),
		];
	}
}
