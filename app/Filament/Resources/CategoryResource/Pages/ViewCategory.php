<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;


class ViewCategory extends ViewRecord
{
    protected static ?string $title = 'Détails sur la categorie';

    protected static string $resource = CategoryResource::class;
}
