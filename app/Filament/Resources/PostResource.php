<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Enum\PostStatus;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'tabler-writing';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Group::make([
                    Forms\Components\Section::make()->schema([
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\TextInput::make('title')
                                ->live()
                                ->afterStateUpdated(function (callable $set, $state) {
                                    $set('slug', str($state)->slug());
                                })
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->maxLength(255)
                                ->unique(Post::class, 'slug', ignoreRecord: true),
                            SpatieTagsInput::make('categories')
                                ->type('categories'),
                            SpatieTagsInput::make('tags')
                                ->type('tags'),
                            Select::make('status')
                                ->options(PostStatus::class)
                                ->default('draft')
                                ->columnSpanFull()
                                ->allowHtml()
                                ->required()
                        ]),
                        SpatieMediaLibraryFileUpload::make('images')
                            ->hint(__('Upload images related to the post'))
                            ->columnSpanFull()
                            ->image()
                            ->collection('images')
                            ->multiple(),
                        Forms\Components\RichEditor::make('content')
                            ->columnSpan('full')
                            ->required(),
                    ]),
                ])->columnSpan(2),
                Forms\Components\Group::make([
                    Forms\Components\Section::make(__('settings'))->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Post')
                            ->helperText(__('mark this post as featured'))
                            ->formatStateUsing(fn($record) => $record?->featured_at ? true : false)
                            ->default(false),
                    ])
                ])

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('content')
                    ->formatStateUsing(fn ($state) => strip_tags($state))
                    ->limit(50),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\SpatieTagsColumn::make('tags')
                    ->type('categories')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'view' => Pages\ViewPost::route('/{record}'),
        ];
    }
}
