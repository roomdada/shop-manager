<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrivateSaleResource\Pages;
use App\Filament\Resources\PrivateSaleResource\RelationManagers;
use App\Models\PrivateSale;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListPrivateSales::route('/'),
            'create' => Pages\CreatePrivateSale::route('/create'),
            'edit' => Pages\EditPrivateSale::route('/{record}/edit'),
        ];
    }
}
