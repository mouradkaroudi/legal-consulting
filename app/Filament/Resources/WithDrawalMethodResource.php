<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WithDrawalMethodResource\Pages;
use App\Models\Country;
use App\Models\WithdrawalMethod;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;

class WithDrawalMethodResource extends Resource
{
    protected static ?string $model = WithdrawalMethod::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? static::$navigationLabel ?? __('filament::resources/withdrawals-methods.label.plural');
    }

    public static function getPluralModelLabel(): string
    {
        return static::$pluralModelLabel ?? static::$pluralModelLabel ?? __('filament::resources/withdrawals-methods.label.plural');
    }

    public static function getModelLabel(): string
    {
        return static::$modelLabel ?? static::$modelLabel ?? __('filament::resources/withdrawals-methods.label.singular');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('Financial Management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Group::make([
                            Card::make([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('filament::resources/withdrawals-methods.form.fields.name.label'))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('description')
                                    ->label(__('filament::resources/withdrawals-methods.form.fields.description.label'))
                                    ->required()
                                    ->maxLength(255),
                                Grid::make()->schema([
                                    Forms\Components\TextInput::make('minimum_amount')
                                        ->label(__('filament::resources/withdrawals-methods.form.fields.minimum_amount.label')),
                                    Forms\Components\TextInput::make('maximum_amount')
                                        ->label(__('filament::resources/withdrawals-methods.form.fields.maximum_amount.label'))
                                ]),
                                Forms\Components\Select::make('countries')
                                    ->label(__('filament::resources/withdrawals-methods.form.fields.countries.label'))
                                    ->helperText(__('filament::resources/withdrawals-methods.form.fields.countries.helperText'))
                                    ->multiple()
                                    ->preload()
                                    ->relationship('countries', 'id')
                                    ->options(function () {
                                        return Country::all()->pluck('name', 'id');
                                    }),
                            ]),
                            Card::make([
                                Forms\Components\TextInput::make('min_fee')
                                    ->label(__('filament::resources/withdrawals-methods.form.fields.min_fee.label')),
                                Forms\Components\TextInput::make('max_fee')
                                    ->label(__('filament::resources/withdrawals-methods.form.fields.max_fee.label')),
                                Forms\Components\TextInput::make('percentage_fee')
                                    ->label(__('filament::resources/withdrawals-methods.form.fields.percentage_fee.label')),
                            ]),
                        ])->columnSpan(1),
                        Group::make([
                            Card::make([
                                Forms\Components\Repeater::make('information_required')
                                    ->label(__('filament::resources/withdrawals-methods.form.fields.information_required.label'))
                                    ->schema([
                                        TextInput::make('field_label')
                                            ->label(__('filament::resources/withdrawals-methods.form.fields.information_required.fields.field_label.label'))
                                            ->helperText(__('filament::resources/withdrawals-methods.form.fields.information_required.fields.field_label.helperText'))
                                    ]),
                            ])

                        ])->columnSpan(1)
                    ])
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
            'index' => Pages\ListWithDrawalMethods::route('/'),
            'create' => Pages\CreateWithDrawalMethod::route('/create'),
            'edit' => Pages\EditWithDrawalMethod::route('/{record}/edit'),
        ];
    }
}
