<?php

namespace App\Filament\Resources\ArticleResource\Widgets;

use App\Models\Article;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ArticleStatsOverviewWidget extends Widget
{
    public function getCards() : array
    {
        return [
             Card::make('Total Products', Article::count()),
            Card::make('Article Inventory', Article::sum('quantity')),
            Card::make('Average price', number_format(Article::avg('price'), 2)),
        ];
    }
}
