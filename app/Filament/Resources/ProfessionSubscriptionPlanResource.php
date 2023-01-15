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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('الإسم')
                    ->required()
                    ,
                Forms\Components\TextInput::make('description')
                    ->label('وصف')->required(),
                Forms\Components\Select::make('profession_id')
                    ->label('المهنة')
                    ->preload()
                    ->relationship('profession', 'name'),
                Forms\Components\TextInput::make('fee')
                    ->label('الرسوم'),
                Forms\Components\Select::make('type')
                    ->label('نوع الإشتراك')
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
