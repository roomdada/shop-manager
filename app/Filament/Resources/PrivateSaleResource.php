<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Article;
use App\Models\PrivateSale;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PrivateSaleResource\Pages;
use App\Filament\Resources\PrivateSaleResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class PrivateSaleResource extends Resource
{
    protected static ?string $model = PrivateSale::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Sherylux - Gestion vente privée';
    protected static ?string $navigationLabel = 'Ventes privées';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    DatePicker::make('opening_date')
                        ->minDate(now())
                        ->required()
                        ->label('Date de début de la vente privée'),
                    DatePicker::make('closing_date')
                        ->minDate(now())
                        ->required()
                        ->label('Date de fin de la vente privée'),
                    Select::make('article_id')->label('Article')->options(
                        Article::query()->isDisponible()->pluck('title', 'id')->toArray()
                    )->placeholder('Veuillez selectionner l\'article à mettre en vente privée')->required(),
                    TextInput::make('quantity')
                        ->required()
                        ->rules(['required', 'numeric',   function () {
                            return function ($attribute, $value, $fail) {
                               $articleId = request()->all()['updates'][2]['payload']['value'];
                               $article = Article::find((int) $articleId);
                                 if ($article->quantity < $value) {
                                      $fail('La quantité en vente privée ne peut pas être supérieure à la quantité en stock');
                                    }
                                // get article_id from request

                            };
                        }])
                        ->label('Quantité à placer en vente privée'),
                    TextInput::make('price')->label('Prix de vente privée'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('opening_date')->label('Date d\'ouverture')->searchable()->sortable(),
                TextColumn::make('closing_date')->label('Date de fermeture')->searchable()->sortable(),
                TextColumn::make('article.title')->label('Article')->searchable()->sortable(),
                TextColumn::make('price')->label('Prix de vente')->searchable()->sortable(),
                TextColumn::make('quantity')->label('Quantité en vente')->searchable()->sortable(),
            ])
            ->filters([

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
            'index' => Pages\ListPrivateSales::route('/'),
            'create' => Pages\CreatePrivateSale::route('/create'),
            'edit' => Pages\EditPrivateSale::route('/{record}/edit'),
        ];
    }
}
