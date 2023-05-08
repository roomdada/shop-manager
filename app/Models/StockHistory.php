<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const SUPPLY = 1;
    public const SALE = 2;

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function label() : Attribute
    {
        return new Attribute(
            get : (int) $this->type === self::SUPPLY ? 'Approvisionnement' : 'Vente privée',
        );
    }
}
