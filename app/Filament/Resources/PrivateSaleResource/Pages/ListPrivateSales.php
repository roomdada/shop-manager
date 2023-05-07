<?php

namespace App\Filament\Resources\PrivateSaleResource\Pages;

use App\Filament\Resources\PrivateSaleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrivateSales extends ListRecords
{
    protected static string $resource = PrivateSaleResource::class;
    protected static ?string $title = 'Articles en vente privée';




    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
