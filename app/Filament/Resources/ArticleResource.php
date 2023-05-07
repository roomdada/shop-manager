<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Kind;
use App\Models\Type;
use Filament\Tables;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Article;
use App\Models\Variant;
use App\Models\Category;
use App\Models\TypeVariant;
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
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Builder\Block;
use App\Filament\Resources\ArticleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Filament\Resources\ArticleResource\Widgets\ArticleStats;
use App\Filament\Resources\ArticleResource\Widgets\ArticleStatsOverviewWidget;
use App\Filament\Resources\ArticleResource\RelationManagers\VariantsRelationManager;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';
    protected static ?string $navigationGroup = 'Sherylux - Gestion article';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }

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
                                ->relationship('model', 'wording'),
                        Select::make('type_id')
                                ->options([Type::pluck('id', 'wording')])
                                ->required()
                                ->relationship('type', 'wording')
                                ->label('Type'),
                        Select::make('kind_id')->options(
                            [Kind::pluck('id', 'wording')]
                        )->relationship('kind', 'wording')->label('Genre'),
                        TextInput::make('quantity')->label('Quantité de base')->required(),
                    ])->columns(2),
                    Section::make('Veuillez renseigner les variantes disponibles pour cet article')->columns(2)->schema([
                        Select::make('Couleur')->label('Couleurs disponibles')->options([
                            'Rouge' => 'Rouge',
                            'Bleu' => 'Bleu',
                            'Vert' => 'Vert',
                            'Jaune' => 'Jaune',
                        ])->placeholder('Sélectionnez les couleurs de cet article disponible')->multiple(),
                        Select::make('Taille')->label('Tailles disponibles')->options([
                            'S' => 'S',
                            'M' => 'M',
                            'L' => 'L',
                            'XL' => 'XL',
                        ])->placeholder('Sélectionnez les tailles de cet article disponible')->multiple(),
                        Select::make('Capacité')->label('Capacités disponibles')->options([
                            '32' => '32',
                            '64' => '64',
                            '128' => '128',
                            '256' => '256',
                        ])->placeholder('Sélectionnez les capacités de cet article disponible')->multiple(),
                        Select::make('Matière')->label('Matières disponibles')->options([
                            'Coton' => 'Coton',
                            'Polyester' => 'Polyester',
                            'Laine' => 'Laine',
                            'Soie' => 'Soie',
                        ])->placeholder('Sélectionnez les matières de cet article disponible')->multiple(),
                    ]),
                    Section::make('Description de l\'article')->columns(2)->schema([
                        RichEditor::make('description')->label('Description'),
                    ])->columns(1),

                    Section::make('Images de l\'article')->columns(2)->schema([
                        FileUpload::make('first_image')->label('Image principale')
                        ->rules(['image', 'mimes:png,jpg,jpeg', 'max:1024'])
                        ->required(),
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
                ImageColumn::make('first_image')->label('Image principale'),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('identifier')->searchable()->sortable()->label('Référence'),
                TextColumn::make('category.title')->searchable()->sortable()->label('Catégorie'),
                TextColumn::make('brand.wording')->searchable()->sortable()->label('Marque'),
                TextColumn::make('model.wording')->searchable()->sortable()->label('Modèle'),
                TextColumn::make('quantity')->searchable()->sortable()->label('Quantité'),
            ])
            ->filters([
                // filter by category
                SelectFilter::make('category_id')
                    ->options(Category::pluck('title', 'id')->toArray())
                    ->label('Catégorie'),
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
          ArticleStats::class,
      ];
  }

    public static function getRelations(): array
    {
        return [
            VariantsRelationManager::class,
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

    public static function relationTable() : Table
    {
        return Table::make('articles')
            ->columns([
                Tables\Columns\TextColumn::make('identifier')->label('Identifiant'),
                Tables\Columns\TextColumn::make('title')->label('Libellé'),
                Tables\Columns\TextColumn::make('quantity')->label('Quantité disponible'),
        ]);
    }
}
