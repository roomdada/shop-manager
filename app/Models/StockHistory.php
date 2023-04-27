<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    use HasFactory;

    protected $guared = [];

    public const SUPPLY = 1;
    public const SALE = 2;

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
