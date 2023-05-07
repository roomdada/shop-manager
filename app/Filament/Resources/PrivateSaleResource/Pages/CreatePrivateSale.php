<?php

namespace App\Filament\Resources\PrivateSaleResource\Pages;

use App\Models\Article;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PrivateSaleResource;

class CreatePrivateSale extends CreateRecord
{
    protected static string $resource = PrivateSaleResource::class;
    protected static ?string $title = 'Créer une vente privée';


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(){
        $quantity = $this->data['quantity'];
        $article = Article::find($this->data['article_id']);
        $article->putOnPrivateSale($quantity);
    }
}
