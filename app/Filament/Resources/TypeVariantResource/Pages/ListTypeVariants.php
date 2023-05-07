<?php

namespace App\Filament\Resources\TypeVariantResource\Pages;

use App\Filament\Resources\TypeVariantResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeVariants extends ListRecords
{
    protected static string $resource = TypeVariantResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
