<?php

namespace App\Filament\Resources\KindResource\Pages;

use App\Filament\Resources\KindResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKind extends EditRecord
{
    protected static string $resource = KindResource::class;
    protected static ?string $title = 'Modifier le genre';

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
