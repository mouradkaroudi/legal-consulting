<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {

        $isCustom = request()->input('custom');

        if (!$isCustom) {
            //return [];
        }

        return $form
            ->schema([
                Forms\Components\Group::make(
                    [
                        Forms\Components\Card::make([
                            Forms\Components\TextInput::make('title')
                                ->required(),
                            Forms\Components\RichEditor::make('content'),

                        ]),
                        Forms\Components\Card::make([
                            Forms\Components\KeyValue::make('metadata')
                                ->disableAddingRows()
                                ->disableDeletingRows()
                                ->disableEditingKeys(),
                        ]),
                    ]
                )->columnSpan(2),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('slug')
                            ->required(),
                        Forms\Components\Select::make('post_type')
                            ->options([
                                Post::TYPE_PAGE => 'Page',
                                Post::TYPE_FAQ => 'Faq'
                            ])
                            ->required(),
                    ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('post_type'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
