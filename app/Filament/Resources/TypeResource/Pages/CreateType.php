<?php

namespace App\Filament\Resources\TypeResource\Pages;

use App\Filament\Resources\TypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateType extends CreateRecord
{
    protected static string $resource = TypeResource::class;
    protected static ?string $title = 'Ajouter un type d\'article';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
