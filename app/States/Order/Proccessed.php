<?php
namespace App\States\Order;

class Proccessed extends OrderState
{
    public static $name = 'proccessed';

    public static function title(): string
    {
        return 'En attente d\'approbation';
    }

    public static function description(): string
    {
        return 'La commande est en attente d\'approbation par Sherylux';
    }
}
