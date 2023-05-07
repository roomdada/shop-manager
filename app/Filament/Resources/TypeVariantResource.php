<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeVariantResource\Pages;
use App\Filament\Resources\TypeVariantResource\RelationManagers;
use App\Models\TypeVariant;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypeVariantResource extends Resource
{
    protected static ?string $model = TypeVariant::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Sherylux - Gestion article';
    protected static ?string $name = 'Type de variant';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Grid::make(1)->schema([
                        Forms\Components\TextInput::make('type')->label('Type de variant'),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->label('Date de création'),
                Tables\Columns\TextColumn::make('type')->label('Type de variant'),
            ])
            ->filters([
                //
            ])
            ->actions([
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypeVariants::route('/'),
            'create' => Pages\CreateTypeVariant::route('/create'),
            'edit' => Pages\EditTypeVariant::route('/{record}/edit'),
        ];
    }
}
