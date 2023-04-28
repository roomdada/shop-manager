<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;
    protected static ?string $title = 'Liste des articles';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

  protected function getHeaderWidgets(): array
  {
        return ArticleResource::getWidgets();
 }

}
