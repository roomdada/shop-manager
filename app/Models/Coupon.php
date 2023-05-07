<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'expires_at' => 'datetime'
    ];



    public function state() : Attribute
    {
       return new Attribute(
         get: function(){
             if($this->is_used){
                return "Déjà utilisé";
             }elseif($this->expires_at < now()){
                return "Expiré";
            }
            return "Valide";
         }
       );
    }

    public function scopeValid($query)
    {
        return $query->where('expires_at', '>', now())->where('is_used', false);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
