<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WithDrawalMethodResource\Pages;
use App\Filament\Resources\WithDrawalMethodResource\RelationManagers;
use App\Models\Country;
use App\Models\WithDrawalMethod;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WithDrawalMethodResource extends Resource
{
    protected static ?string $model = WithDrawalMethod::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Group::make([
                            Card::make([
                                Forms\Components\TextInput::make('name')
                                    ->label('اسم الطريقة')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('description')
                                    ->label('وصف')
                                    ->required()
                                    ->maxLength(255),
                                Grid::make()->schema([
                                    Forms\Components\TextInput::make('minimum_amount')->label('الحد الأدنى للتحويل'),
                                    Forms\Components\TextInput::make('maximum_amount')->label('الحد الأقصى للتحويل'),
                                ]),
                                Forms\Components\Select::make('countries')
                                    ->label('البلدان التي تتوفر فيها هذه الطريقة')
                                    ->helperText('إذا لم يتم تحديد اي البلد ، فستكون متاحًا لجميع البلدان')
                                    ->multiple()
                                    ->preload()
                                    ->relationship('countries', 'id')
                                    ->options(function () {
                                        return Country::all()->pluck('name', 'id');
                                    }),
                            ]),
                            Card::make([
                                Forms\Components\TextInput::make('min_fee')->label('الحد الأدنى للرسوم'),
                                Forms\Components\TextInput::make('max_fee')->label('الحد الأقصى للرسوم'),
                                Forms\Components\TextInput::make('percentage_fee')->label('رسوم النسبة المئوية'),
                            ]),
                        ])->columnSpan(1),
                        Group::make([
                            Card::make([
                                Forms\Components\Repeater::make('information_required')
                                    ->label('المعلومات المطلوبة')
                                    ->schema([
                                        TextInput::make('field_label')->label('اسم الحقل')->helperText('مثل البريد الإلكتروني')
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
