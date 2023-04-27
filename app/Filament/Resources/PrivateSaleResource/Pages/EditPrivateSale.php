<?php

namespace App\Filament\Resources\PrivateSaleResource\Pages;

use App\Filament\Resources\PrivateSaleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrivateSale extends EditRecord
{
    protected static string $resource = PrivateSaleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
