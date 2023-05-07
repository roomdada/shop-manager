<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverviewWidget extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Articles', \App\Models\Article::count())
                ->description('Total des articles')
                ->color('success'),
            Card::make('Commandes', \App\Models\Order::count())
                ->description('0% augmenter')
                ->chart([17, 16, 14, 15, 14, 13, 70])
                ->color('danger'),
            Card::make('Commandes du jour', \App\Models\Order::query()->today()->count())
                ->description('0% augmenter')
                ->color('success'),
               Card::make('Partenaires', \App\Models\Order::query()->today()->count())
                ->description('0% augmenter')
                ->color('success'),
               Card::make('Clients', \App\Models\Order::query()->today()->count())
                ->description('0% augmenter')
                ->color('success'),
               Card::make('Coupons actifs', \App\Models\Coupon::query()->valid()->count())
                ->description('0% augmenter')
                ->color('success'),
        ];
    }
}
