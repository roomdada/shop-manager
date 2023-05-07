<?php

namespace App\Models;

use Spatie\ModelStates\HasStates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, HasStates;

    protected $guarded = [];


    protected $casts = [
        'state' => \App\States\Order\OrderState::class
    ];

    public function coupon()
    {
        return $this->hasOne(Coupon::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'order_articles')->withPivot('quantity');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

}
