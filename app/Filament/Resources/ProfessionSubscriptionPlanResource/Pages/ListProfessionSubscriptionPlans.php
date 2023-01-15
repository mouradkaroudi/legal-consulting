<?php

namespace App\Filament\Resources\ProfessionSubscriptionPlanResource\Pages;

use App\Filament\Resources\ProfessionSubscriptionPlanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ListProfessionSubscriptionPlans extends ListRecords
{
    protected static string $resource = ProfessionSubscriptionPlanResource::class;

    protected function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('profession.name')->label('المهنة'),
                Tables\Columns\TextColumn::make('fee')->label('رسوم الإشتراك'),
                Tables\Columns\TextColumn::make('type')->label('نوع الإشتراك')
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

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
