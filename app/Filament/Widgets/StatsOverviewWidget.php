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
            Card::make('Articles', '3000')
                ->description('32k augmenter')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Card::make('Commandes', '1340')
                ->description('3% augmenter')
                ->descriptionIcon('heroicon-s-trending-down')
                ->chart([17, 16, 14, 15, 14, 13, 70])
                ->color('danger'),
            Card::make('Commandes du jour', '3543')
                ->description('7% augmenter')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([15, 4, 10, 2, 12, 4, 12])
                ->color('success'),
        ];
    }
}
