<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrdersResource\Pages;
use App\Filament\Resources\OrdersResource\RelationManagers;
use App\Models\Order;
use App\Models\Orders;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static function getNavigationLabel(): string
	{
		return static::$navigationLabel ?? static::$navigationLabel ?? __('filament::resources/orders.label.plural');
	}

	public static function getPluralModelLabel(): string
	{
		return static::$pluralModelLabel ?? static::$pluralModelLabel ?? __('filament::resources/orders.label.plural');
	}

	public static function getModelLabel(): string
	{
		return static::$modelLabel ?? static::$modelLabel ?? __('filament::resources/orders.label.singular');
	}

	protected static function getNavigationGroup(): ?string
    {
        return __('Financial Management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("id")->label("#"),
                \Filament\Tables\Columns\TextColumn::make("office.name")
				->label(__('Name')),
                Tables\Columns\TextColumn::make("beneficiary.name")->label(
                    __('Beneficiary')
                ),
                Tables\Columns\TextColumn::make("subject")
                    ->label(__('Subject')),
                Tables\Columns\TextColumn::make("amount")
                    ->label(__('Amount'))
                    ->money("sar", true),
                Tables\Columns\BadgeColumn::make("status")
                    ->label(__('Status'))
                    ->enum([
                        Order::PAID => __("orders.paid"),
                        Order::UNPAID => __("orders.unpaid"),
                    ]),
                Tables\Columns\TextColumn::make("created_at")
                    ->label(__('Created at'))
                    ->date()
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageOrders::route('/'),
        ];
    }    
}
