<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Type;
use Filament\Tables;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ArticleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Filament\Resources\ArticleResource\Widgets\ArticleStatsOverviewWidget;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';
    protected static ?string $navigationGroup = 'Sherylux - Gestion article';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // generate form    with multiple tabs and variants managment for article
                Group::make()->schema([
                    Card::make()->schema([
                        TextInput::make('title')->label('Titre')
                                ->lazy()
                                ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                                    ->disabled()
                                    ->required()
                                    ->unique(Article::class, 'slug', ignoreRecord: true),
                        TextInput::make('price')->label('Prix de base')->required(),
                        Select::make('category_id')
                                ->options([Category::pluck('id', 'title')])
                                ->relationship('category', 'title')
                                ->required()
                                ->label('Catégorie'),
                        Select::make('brand_id')
                                ->options([Brand::pluck('id', 'wording')])
                                ->relationship('brand', 'wording')
                                ->required()
                                ->label('Marque'),
                      Select::make('model_id')
                                ->options([Model::pluck('id', 'wording')])
                                ->searchable()
                                ->relationship('model', 'wording'),
                        Select::make('type_id')
                                ->options([Type::pluck('id', 'wording')])
                                ->required()
                                ->relationship('type', 'wording')
                                ->label('Type'),
                    ])->columns(2),

                    Section::make('Description de l\'article')->columns(2)->schema([
                        RichEditor::make('description')->label('Description'),
                    ])->columns(1),


                    // add variante for

                Section::make('Variante de l\'article')->columns(2)->schema([
                        Toggle::make('toggle_field_name')->label('Ce article a plusieurs variants ?')->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('variants', []) : null),

                        // show variantes if toggle is true$
                        Repeater::make('variants')
                            ->createItemButtonLabel('Ajouter une variante')
                            ->orderable()
                            ->schema([
                                TextInput::make('variant')->required(),
                                TextInput::make('variant')->required(),
                                TextInput::make('price')->required(),
                                TextInput::make('quantity')->required()
                                ->required(),
                            ])
                            ->columns(2)
                    ])->columns(1),

                    Section::make('Images de l\'article')->columns(2)->schema([
                        FileUpload::make('first_image')->label('Image principale')->required(),
                        FileUpload::make('second_image')->label('Image secondaire'),
                        FileUpload::make('third_image')->label('Dernière image'),
                    ])->columns(1),
                ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('identifier')->searchable()->sortable()->label('Référence'),
                TextColumn::make('category.title')->searchable()->sortable()->label('Catégorie'),
                TextColumn::make('brand.wording')->searchable()->sortable()->label('Marque'),
                TextColumn::make('model.wording')->searchable()->sortable()->label('Modèle'),
                TextColumn::make('quantity')->searchable()->sortable()->label('Quantité'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('')->color('success')->icon('heroicon-o-eye'),
                Tables\Actions\EditAction::make()->label('')->color('yellow')->icon('heroicon-o-pencil'),
                Tables\Actions\DeleteAction::make()->label('')->color('danger')->icon('heroicon-o-trash')
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getWidgets(): array
    {
        return [
            ArticleStatsOverviewWidget::class
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getGloballySearchableAttributes(): array
    {
        return ['identifier','brand.wording','model.wording','category.title','title','description'];
    }

    protected static function getNavigationBadge(): ?string
    {
        return self::$model::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
