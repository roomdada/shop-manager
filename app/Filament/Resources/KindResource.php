<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KindResource\Pages;
use App\Filament\Resources\KindResource\RelationManagers;
use App\Models\Kind;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KindResource extends Resource
{
    protected static ?string $model = Kind::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Sherylux - Parametre article';
    protected static ?string $navigationLabel = 'Genres';

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
            'index' => Pages\ListKinds::route('/'),
            'create' => Pages\CreateKind::route('/create'),
            'edit' => Pages\EditKind::route('/{record}/edit'),
        ];
    }
}
