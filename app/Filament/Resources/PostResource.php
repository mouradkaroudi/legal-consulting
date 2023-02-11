<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
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

    protected static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? static::$navigationLabel ?? __('filament::resources/posts.label.plural');
    }

    public static function getPluralModelLabel(): string
    {
        return static::$pluralModelLabel ?? static::$pluralModelLabel ?? __('filament::resources/posts.label.plural');
    }

    public static function getModelLabel(): string
    {
        return static::$modelLabel ?? static::$modelLabel ?? __('filament::resources/posts.label.singular');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('Content Management');
    }

    public static function form(Form $form): Form
    {

        $postmetaSchema = [];

        $postmetaSchema = [
            Forms\Components\FileUpload::make('meta.bg_image')
                ->label(__('filament::resources/posts.form.fields.meta.fields.bg_image.label')),
            Forms\Components\ColorPicker::make('meta.text_color')
                ->label(__('filament::resources/posts.form.fields.meta.fields.text_color.label')),
            Forms\Components\ColorPicker::make('meta.bg_color')
                ->label(__('filament::resources/posts.form.fields.meta.fields.bg_color.label')),
        ];

        return $form
            ->schema([
                Forms\Components\Group::make(
                    [
                        Forms\Components\Card::make([
                            Forms\Components\TextInput::make('title')
                                ->label(__('filament::resources/posts.form.fields.title.label'))
                                ->required(),
                            Forms\Components\Textarea::make('content')
                                ->label(__('filament::resources/posts.form.fields.content.label'))
                                ->required(),
                        ]),
                        Forms\Components\Card::make([
                            Forms\Components\KeyValue::make('metadata')
                                ->label(__('filament::resources/posts.form.fields.seo.label'))
                                ->disableAddingRows()
                                ->disableDeletingRows()
                                ->disableEditingKeys(),
                        ]),
                    ]
                )->columnSpan(2),
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('slug')
                        ->label(__('filament::resources/posts.form.fields.slug.label'))
                        ->required(),
                    Forms\Components\Select::make('post_type')
                        ->label(__('filament::resources/posts.form.fields.post_type.label'))
                        ->options([
                            Post::TYPE_PAGE => 'Page',
                            Post::TYPE_FAQ => 'Faq',
                            'slide' => 'Slide',
                        ])
                        ->required(),
                ])->columnSpan(1),
                Forms\Components\Card::make($postmetaSchema)
                    ->visible(fn ($state, callable $get) => $get('post_type') === 'slide'),
                Forms\Components\Hidden::make('post_type')
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament::resources/posts.table.columns.title.label')),
                Tables\Columns\TextColumn::make('post_type')
                    ->label(__('filament::resources/posts.table.columns.post_type.label')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament::resources/posts.table.columns.updated_at.label'))
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
            'edit' => Pages\EditPost::route('/{record}/edit')
        ];
    }
}
