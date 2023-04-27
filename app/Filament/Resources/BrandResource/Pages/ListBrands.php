<?php

namespace App\Filament\Resources\BrandResource\Pages;

use App\Filament\Resources\BrandResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBrands extends ListRecords
{
    protected static string $resource = BrandResource::class;

    protected static ?string $title = 'Liste des marques';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
