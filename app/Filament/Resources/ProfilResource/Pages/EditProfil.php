<?php

namespace App\Filament\Resources\ProfilResource\Pages;

use App\Filament\Resources\ProfilResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfil extends EditRecord
{
    protected static string $resource = ProfilResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
