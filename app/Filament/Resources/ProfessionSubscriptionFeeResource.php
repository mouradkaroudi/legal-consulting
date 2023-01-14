<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionSubscriptionFeeResource\Pages;
use App\Filament\Resources\ProfessionSubscriptionFeeResource\RelationManagers;
use App\Models\ProfessionSubscriptionFee;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;

class ProfessionSubscriptionFeeResource extends Resource
{
    protected static ?string $model = ProfessionSubscriptionFee::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            'index' => Pages\ListProfessionSubscriptionFees::route('/'),
            'create' => Pages\CreateProfessionSubscriptionFee::route('/create'),
            'edit' => Pages\EditProfessionSubscriptionFee::route('/{record}/edit'),
        ];
    }
}
