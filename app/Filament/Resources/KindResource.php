<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Kind;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KindResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KindResource\RelationManagers;

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
                Card::make()->schema([
                    Grid::make(1)->schema([
                        TextInput::make('wording')->label('Libellé'),
                        Textarea::make('description')->label('Description du genre'),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->label('Date de création')->searchable()->sortable(),
                TextColumn::make('wording')->label('Libellé')->searchable()->sortable(),
                TextColumn::make('articles_count')->label('Nombre d\'articles')->searchable()->sortable(),
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
            //
        ];
    }

  public static function getGloballySearchableAttributes(): array
    {
        return [
            'wording',
        ];
    }

    protected static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['articles']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKinds::route('/'),
            'create' => Pages\CreateKind::route('/create'),
            'view' => Pages\ViewKind::route('/{record}'),
            'edit' => Pages\EditKind::route('/{record}/edit'),
        ];
    }
}
