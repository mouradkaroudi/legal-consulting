<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DigitalOfficeResource\Pages;
use App\Filament\Resources\DigitalOfficeResource\RelationManagers;
use App\Models\DigitalOffice;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DigitalOfficeResource extends Resource
{
    protected static ?string $model = DigitalOffice::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? static::$navigationLabel ?? __('filament::resources/offices.label.plural');
    }

    public static function getPluralModelLabel(): string
    {
        return static::$pluralModelLabel ?? static::$pluralModelLabel ?? __('filament::resources/offices.label.plural');
    }

    public static function getModelLabel(): string
    {
        return static::$modelLabel ?? static::$modelLabel ?? __('filament::resources/offices.label.singular');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('Users & Offices');
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament::resources/offices.table.columns.name.label')),
                Tables\Columns\TextColumn::make('owner.name')
                    ->label(__('filament::resources/offices.table.columns.ownerName.label')),
                Tables\Columns\TextColumn::make('subscription.plan_id')
                    ->label(__('filament::resources/offices.table.columns.subscriptionPlan.label'))
                    ->enum([
                        null => 'غير مشترك'
                    ]),
                Tables\Columns\TextColumn::make('country.name')
                    ->label(__('filament::resources/offices.table.columns.countryName.label')),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('filament::resources/offices.table.columns.status.label'))
                    ->enum([
                        DigitalOffice::AVAILABLE => __('offices.status.available'),
                        DigitalOffice::BUSY => __('offices.status.busy'),
                        DigitalOffice::UNCOMPLETED => __('offices.status.uncompleted'),
                    ])->color(function ($record) {

                        if ($record->status == DigitalOffice::AVAILABLE) {
                            return 'success';
                        }

                        if ($record->status == DigitalOffice::BUSY) {
                            return 'warning';
                        }

                        return 'secondary';
                    }),
                Tables\Columns\CheckboxColumn::make('is_hidden')
                    ->label(__('filament::resources/offices.table.columns.is_hidden.label'))
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('editDisplayInfo')
                        ->label(__('filament::resources/offices.table.actions.displayInfo.label'))
                        ->mountUsing(fn (Forms\ComponentContainer $form, $record) => $form->fill([
                            'display_info' => $record->display_info,
                        ]))
                        ->action(function ($record, $data) {
                            $fields = $data['display_info'];
                            $record->display_info = $fields;
                            $record->save();
                        })
                        ->form([
                            Select::make('display_info')
                                ->label(__('filament::resources/offices.table.actions.displayInfo.label'))
                                ->multiple()
                                ->options([
                                    'phone_number' => __('validation.attributes.phone'),
                                    'email' => __('validation.attributes.email')
                                ])
                        ]),
                    Tables\Actions\Action::make('viewProfile')
                        ->label(__('filament::resources/offices.table.actions.viewProfile.label'))
                        ->url(fn (DigitalOffice $record) => route('search.office', [
                            'service' => $record->service,
                            'profession' => $record->profession,
                            'digitalOffice' => $record->id,
                            'name' => $record->url_name
                        ]))
                        ->openUrlInNewTab()
                        ->visible(fn ($record) => $record->status != DigitalOffice::UNCOMPLETED)
                        ->icon('heroicon-o-external-link'),
                    Tables\Actions\Action::make('ban')
                        ->label(__('filament::resources/offices.table.actions.ban.label'))
                        ->action(function ($record) {
                            $record->banned_at = Carbon::now();
                            $record->save();
                        })
                        ->icon('heroicon-o-ban')
                        ->color('danger')
                        ->visible(fn ($record) => !$record->isBanned()),
                    Tables\Actions\Action::make('unban')
                        ->label(__('filament::resources/offices.table.actions.unban.label'))
                        ->action(function ($record) {
                            $record->banned_at = null;
                            $record->save();
                        })
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->visible(fn ($record) => $record->isBanned())
                ]),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDigitalOffices::route('/'),
            //'create' => Pages\CreateDigitalOffice::route('/create'),
            'edit' => Pages\EditDigitalOffice::route('/{record}/edit'),
        ];
    }
}
