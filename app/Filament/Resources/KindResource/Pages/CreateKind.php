<?php

namespace App\Filament\Resources\KindResource\Pages;

use App\Filament\Resources\KindResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKind extends CreateRecord
{
    protected static string $resource = KindResource::class;
    protected static ?string $title = 'Ajouter un genre pour les articles';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
