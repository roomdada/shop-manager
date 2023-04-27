<?php

namespace App\Filament\Resources\ModelResource\Pages;

use App\Filament\Resources\ModelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModel extends EditRecord
{
    protected static string $resource = ModelResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
