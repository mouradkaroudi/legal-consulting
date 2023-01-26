<?php

namespace App\Filament\Resources\WithDrawalMethodResource\Pages;

use App\Filament\Resources\WithDrawalMethodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ListWithDrawalMethods extends ListRecords
{
    protected static string $resource = WithDrawalMethodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament::resources/withdrawals-methods.table.columns.name.label')),
                Tables\Columns\TextColumn::make('minimum_amount')
                    ->label(__('filament::resources/withdrawals-methods.table.columns.minimum_amount.label')),
                Tables\Columns\TextColumn::make('maximum_amount')
                    ->label(__('filament::resources/withdrawals-methods.table.columns.maximum_amount.label')),
                Tables\Columns\TextColumn::make('fees')
                    ->label(__('filament::resources/withdrawals-methods.table.columns.fees.label')),
                Tables\Columns\IconColumn::make('')
                    ->boolean(),

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
}
