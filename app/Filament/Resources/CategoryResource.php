<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Filament\Resources\CategoryResource\RelationManagers\ArticlesRelationManager;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';
    protected static ?string $navigationGroup = 'Sherylux - Parametre article';
    protected static ?string $navigationLabel = 'Categories';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('articles')->withCount('articles');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Grid::make(1)->schema([
                        Forms\Components\TextInput::make('title')->label('Libellé'),
                        Forms\Components\Textarea::make('description')->label('Description de la categorie'),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->label('Date de création')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->label('Libellé')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('articles_count')->label('Nombre d\'articles')->searchable()->sortable(),
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

    public static function getRelations(): array
    {
        return [
            ArticlesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'title',
        ];
    }
}
