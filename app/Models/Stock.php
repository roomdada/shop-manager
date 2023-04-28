<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function article() : BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function inventories() : HasMany
    {
        return $this->hasMany(StockHistory::class);
    }


}
