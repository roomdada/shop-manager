<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrivateSale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function scopeClosed($query)
    {
        return $query->where('closing_date', '<', now());
    }

    public function scopeOpened($query)
    {
        return $query->where('opening_date', '<', now());
    }

    public function scopeIsDisponible($query)
    {
        return $query->where('quantity', '>', 0);
    }

    public static function booted()
    {
        static::creating(function ($privateSale) {
            $privateSale->identifier = strtoupper(substr(md5(uniqid()), 0, 4));
        });
    }

    public function openingDate() : Attribute
    {
        return new Attribute(
            get: fn () => Carbon::parse($this->attributes['opening_date'])->format('d/m/Y'),
        );
    }

     public function closingDate() : Attribute
    {
        return new Attribute(
            get: fn () => Carbon::parse($this->attributes['opening_date'])->format('d/m/Y'),
        );
    }
}
