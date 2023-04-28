<?php

namespace App\Filament\Resources\CouponResource\Pages;

use App\Filament\Resources\CouponResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCoupon extends CreateRecord
{
    protected static string $resource = CouponResource::class;
    protected static ?string $title = 'Ajouter un coupon';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
