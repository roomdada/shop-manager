<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Brand;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BrandResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BrandResource\RelationManagers;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Sherylux - Parametre article';
    protected static ?string $navigationLabel = 'Marques';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('articles')->withCount('articles');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make(1)->schema([
                        TextInput::make('wording')->label('Libellé'),
                         Textarea::make('description')->label('Description de la categorie'),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->label('Date de création'),
                TextColumn::make('wording')->label('Libellé'),
                TextColumn::make('articles_count')->label('Nombre d\'articles'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('show')->label('')->icon('heroicon-o-eye')->color('primary')
                    ->link('filament.resources.brands.edit', fn (Brand $brand) => ['brand' => $brand]),
                Tables\Actions\EditAction::make()->label('')->color('yellow'),
                Tables\Actions\DeleteAction::make()->label('')->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ];
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
