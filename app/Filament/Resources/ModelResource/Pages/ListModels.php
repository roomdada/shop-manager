<?php

namespace App\Filament\Resources\ModelResource\Pages;

use App\Filament\Resources\ModelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModels extends ListRecords
{
    protected static string $resource = ModelResource::class;
    protected static ?string $title = 'Liste des modèles';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
