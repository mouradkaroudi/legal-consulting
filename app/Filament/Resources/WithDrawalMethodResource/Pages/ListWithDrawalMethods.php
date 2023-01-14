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
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('description'),
            Tables\Columns\IconColumn::make('is_available')
                ->boolean(),
            Tables\Columns\TextColumn::make('minimum_amount'),
            Tables\Columns\TextColumn::make('maximum_amount'),
            Tables\Columns\TextColumn::make('fees'),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime(),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime(),
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
