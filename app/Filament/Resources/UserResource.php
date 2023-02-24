<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Country;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? static::$navigationLabel ?? __('filament::resources/users.label.plural');
    }

    public static function getPluralModelLabel(): string
    {
        return static::$pluralModelLabel ?? static::$pluralModelLabel ?? __('filament::resources/users.label.plural');
    }

    public static function getModelLabel(): string
    {
        return static::$modelLabel ?? static::$modelLabel ?? __('filament::resources/users.label.singular');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('Users & Offices');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('Name'))
                            ->inlineLabel(),
                        Forms\Components\TextInput::make('email')
                            ->label(__('validation.attributes.email'))
                            ->inlineLabel(),
                        Forms\Components\TextInput::make('ID_number')
                            ->label(__('validation.attributes.ID'))
                            ->inlineLabel(),
                        Forms\Components\TextInput::make('phone_number')
                            ->label(__('validation.attributes.phone'))
                            ->inlineLabel(),
                        Forms\Components\TextInput::make('country_id')
                            ->label(__('validation.attributes.nationality'))
                            ->inlineLabel(),
                        Forms\Components\Placeholder::make('ID_image')
                            ->label(__('validation.attributes.ID_image'))
                            ->content(fn($record) => new HtmlString('<a href="'.asset('storage/' . $record->ID_image).'" target="_blank">' .__('File link'). '</a>'))
                            ->inlineLabel(),
                        Forms\Components\Placeholder::make('driving_license_image')
                            ->label(__('Driving license image'))
                            ->content(fn($record) => new HtmlString('<a href="'.asset('storage/' . $record->driving_license_image).'" target="_blank">' .__('File link'). '</a>'))
                            ->inlineLabel(),
                        Forms\Components\TextInput::make('preferred_lang')
                            ->label(__('validation.attributes.language'))
                            ->inlineLabel(),
                        Forms\Components\TextInput::make('address')
                            ->label(__('validation.attributes.address'))
                            ->inlineLabel(),
                        Forms\Components\TextInput::make('gender')
                            ->label(__('validation.attributes.sex'))
                            ->inlineLabel(),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('الإسم'),
                Tables\Columns\TextColumn::make('email')->label('البريد الإلكتروني'),
                Tables\Columns\CheckboxColumn::make('contact_hidden_offices')->label('الوصل للمكتاب المخفية'),
                Tables\Columns\TextColumn::make('created_at')->label('تاريخ التسجيل')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->mutateRecordDataUsing(function (array $data): array {
                        if(!empty($data['country_id'])) {
                            $data['country_id'] = Country::where('id', $data['country_id'])->with('translation')->first()->translation->name;
                        }
                        return $data;
                    }),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('ban')
                        ->label(__('filament::resources/users.table.actions.ban.label'))
                        ->action(function ($record) {
                            $record->banned_at = Carbon::now();
                            $record->save();
                        })
                        ->icon('heroicon-o-ban')
                        ->color('danger')
                        ->visible(fn ($record) => !$record->isBanned()),
                    Tables\Actions\Action::make('unban')
                        ->label(__('filament::resources/users.table.actions.unban.label'))
                        ->action(function ($record) {
                            $record->banned_at = null;
                            $record->save();
                        })
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->visible(fn ($record) => $record->isBanned())
                ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //RelationManagers\ProfilesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
            //'view' => Pages\ViewUser::route('/{record}'),
        ];
    }
}
