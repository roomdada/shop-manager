<?php

namespace App\States\Order;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class OrderState extends State
{
    abstract public static function title(): string;

    abstract public static function description(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Confirmed::class)
            ->allowTransition(Confirmed::class, Completed::class)
            ->allowTransition(Confirmed::class, Cancelled::class)
            ->allowTransition(Completed::class, Confirmed::class)
            ->allowTransition(Completed::class, Cancelled::class)
            ->allowTransition(Completed::class, Delivered::class)
        ;
    }
}
