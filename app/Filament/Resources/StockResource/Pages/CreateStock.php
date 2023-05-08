<?php

namespace App\Filament\Resources\StockResource\Pages;

use App\Filament\Resources\StockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStock extends CreateRecord
{
    protected static string $resource = StockResource::class;
    protected static ?string $title = "Approvisionner le stock";

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(){
        $quantity = $this->data['quantity'];
        $stock = \App\Models\Article::find($this->data['article_id'])->stock;
        $stock->addStock($quantity);
    }
}
