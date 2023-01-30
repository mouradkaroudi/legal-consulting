<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionSubscriptionPlanResource\Pages;
use App\Filament\Resources\ProfessionSubscriptionPlanResource\RelationManagers;
use App\Models\ProfessionSubscriptionPlan;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;

class ProfessionSubscriptionPlanResource extends Resource
{
    protected static ?string $model = ProfessionSubscriptionPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? static::$navigationLabel ?? __('filament::resources/professions-subscriptions-plans.label.plural');
    }

    public static function getPluralModelLabel(): string
    {
        return static::$pluralModelLabel ?? static::$pluralModelLabel ?? __('filament::resources/professions-subscriptions-plans.label.plural');
    }

    public static function getModelLabel(): string
    {
        return static::$modelLabel ?? static::$modelLabel ?? __('filament::resources/professions-subscriptions-plans.label.singular');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('Content Management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('filament::resources/professions-subscriptions-plans.form.fields.name.label'))
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->label(__('filament::resources/professions-subscriptions-plans.form.fields.description.label'))
                    ->required(),
                Forms\Components\Select::make('profession_id')
                    ->label(__('filament::resources/professions-subscriptions-plans.form.fields.profession_id.label'))
                    ->preload()
                    ->relationship('professionTranslation', 'name'),
                Forms\Components\TextInput::make('fee')
                    ->label(__('filament::resources/professions-subscriptions-plans.form.fields.fee.label')),
                Forms\Components\Select::make('type')
                    ->label(__('filament::resources/professions-subscriptions-plans.form.fields.type.label'))
                    ->options([
                        'one-time' => 'دفعة لمرة واحدة',
                        'monthly' => 'اشتراك شهري',
                        'yearly' => 'اشتراك سنوي',
                    ]),
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
            'index' => Pages\ListProfessionSubscriptionPlans::route('/'),
            'create' => Pages\CreateProfessionSubscriptionPlan::route('/create'),
            'edit' => Pages\EditProfessionSubscriptionPlan::route('/{record}/edit'),
        ];
    }
}
