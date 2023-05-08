<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Stock;
use App\Models\Article;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StockResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StockResource\RelationManagers;

class StockResource extends Resource
{
    protected static ?string $model = Stock::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';
    protected static ?string $navigationGroup = 'Sherylux - Gestion article';
    protected static ?string $navigationLabel = 'Stocks';

     public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('article')->latest();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('identifier')->label('Ref Stock')->disabled(),
                    TextInput::make('article.identifier')->label('Ref article')->disabled(),
                    TextInput::make('quantity_stoked')
                        ->required()
                        ->hidden(fn() => request()->route()->getName() === 'filament.resource.create')
                        ->rules(['required', 'numeric'])
                        ->label('Quantité à approvisionner'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->label('Date de création')->searchable()->sortable(),
                TextColumn::make('identifier')->label('Ref Stock')->searchable()->sortable(),
                TextColumn::make('article.identifier')->label('Ref article')->searchable()->sortable(),
                TextColumn::make('quantity_stoked')->label('Quantité')->searchable()->sortable(),
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
            'index' => Pages\ListStocks::route('/'),
            'create' => Pages\CreateStock::route('/create'),
            'edit' => Pages\EditStock::route('/{record}/edit'),
        ];
    }
}
