<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionResource\Pages;
use App\Filament\Resources\SubscriptionResource\RelationManagers;
use App\Models\DigitalOffice;
use App\Models\Subscription;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? static::$navigationLabel ?? __('filament::resources/subscriptions.label.plural');
    }

    public static function getPluralModelLabel(): string
    {
        return static::$pluralModelLabel ?? static::$pluralModelLabel ?? __('filament::resources/subscriptions.label.plural');
    }

    public static function getModelLabel(): string
    {
        return static::$modelLabel ?? static::$modelLabel ?? __('filament::resources/subscriptions.label.singular');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('Financial Management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('started_at')
                    ->label(__('filament::resources/subscriptions.form.fields.started_at.label'))
                    ->required(),
                Forms\Components\DateTimePicker::make('expire_at')
                    ->label(__('filament::resources/subscriptions.form.fields.expire_at.label'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('started_at')
                    ->label(__('filament::resources/subscriptions.table.columns.started_at.label'))
                    ->date(),
                Tables\Columns\TextColumn::make('expire_at')
                    ->label(__('filament::resources/subscriptions.table.columns.expire_at.label'))
                    ->date(),
                Tables\Columns\TextColumn::make('subscriber.name')
                    ->label(__('filament::resources/subscriptions.table.columns.subscriberName.label')),
                Tables\Columns\TextColumn::make('subscriber.profession.name')
                    ->label(__('filament::resources/subscriptions.table.columns.professionName.label')),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
            //'create' => Pages\CreateSubscription::route('/create'),
            //'edit' => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }
}
