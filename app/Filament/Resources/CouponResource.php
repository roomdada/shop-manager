<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Sherylux - Gestion article';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                  Forms\Components\Card::make()->schema([
                    Forms\Components\Grid::make(1)->schema([
                        Forms\Components\TextInput::make('code')->label('Code coupon'),
                        Forms\Components\TextInput::make('discount')->label('Rémise en % a appliquer'),
                        DatePicker::make('expires_at')->label('Date d\'expiration'),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date de création'),
                Tables\Columns\TextColumn::make('code')->label('Code coupon'),
                Tables\Columns\TextColumn::make('discount')->label('Rémise en % a appliquer'),
                Tables\Columns\TextColumn::make('expires_at')->label('Date d\'expiration'),
                BadgeColumn::make('state')->label('Statut')->colors([
                    'Valide' => 'primary',
                    'Expiré' => 'danger',
                    'Déjà utilisé' => 'warning',
                ]),
            ])
            ->filters([
                // filter by state
                Tables\Filters\SelectFilter::make('state')
                    ->placeholder('Statut')
                    ->options([
                        'valided' => 'Valide',
                        'expired' => 'Expiré',
                        'used' => 'Déjà utilisé',
                    ])->query(function ($query, $state) {
                        if ($state === 'valided') {
                            $query->where('is_used', false);
                        } elseif ($state === 'expired') {
                            $query->where('expires_at', '<', now());
                        } elseif ($state === 'used') {
                            $query->whereNotNull('used_at');
                        }
                    })
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
