<?php

namespace App\Filament\Resources\BrandResource\Pages;

use App\Filament\Resources\BrandResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBrand extends CreateRecord
{
    protected static string $resource = BrandResource::class;
    protected static ?string $title = 'Ajouter une categorie d\'article';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
