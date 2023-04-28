<?php

namespace App\Filament\Resources\ModelResource\Pages;

use App\Filament\Resources\ModelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModel extends CreateRecord
{
    protected static ?string $title = 'Ajouter un modèle';
    protected static string $resource = ModelResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
