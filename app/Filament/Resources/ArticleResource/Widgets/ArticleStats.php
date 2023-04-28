<?php

namespace App\Filament\Resources\ArticleResource\Widgets;

use App\Models\Article;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;


class ArticleStats extends BaseWidget
{
    //protected static string $view = 'filament.resources.article-resource.widgets.article-stats';

    protected function getCards() : array
    {
        return [
           Card::make('Total article', Article::count()),
            Card::make('Nombre d\'article en stock', Article::sum('quantity')),
            Card::make('Prix moyen', number_format(Article::avg('price'), 2)),
        ];
    }
}
