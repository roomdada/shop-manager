<?php

namespace App\Filament\Resources\TypeResource\Pages;

use App\Filament\Resources\TypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypes extends ListRecords
{
    protected static string $resource = TypeResource::class;
    protected static ?string $title = 'Liste des types d\'article';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
