<?php

namespace App\States\Order;

class Completed extends OrderState
{
    public static $name = 'completed';

    public static function title(): string
    {
        return 'Validée';
    }

    public static function description(): string
    {
        return 'La commande a été validée par Sherylux';
    }
}
