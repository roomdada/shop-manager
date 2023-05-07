<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function kind()
    {
        return $this->belongsTo(Kind::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function stock() : HasOne
    {
        return $this->hasOne(Stock::class, 'article_id');
    }

    public function model()
    {
        return $this->belongsTo(\App\Models\Model::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        });
    }

    public function scopeIsDisponible($query)
    {
        $query->whereHas('stock', function ($query) {
            $query->where('quantity', '>', 0);
        });
    }

    public function scopeIsNotDisponible($query)
    {
        $query->whereHas('stock', function ($query) {
            $query->where('quantity', '=', 0);
        });
    }

    public function putOnPrivateSale(int $quantityInSale)
    {
        $this->quantity -= $quantityInSale;
        $this->save();
        $this->stock->decrement('quantity_stoked', $quantityInSale);
    }


    public function scopeSort($query, array $sort)
    {
        $query->when($sort['field'] ?? false, function ($query, $field) use ($sort) {
            $query->orderBy($field, $sort['order'] ?? 'asc');
        });
    }

    public function typeVariants()
    {
        return $this->hasMany(TypeVariant::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public static function booted()
    {
        static::creating(function ($article) {
            $article->identifier = Str::upper(substr($article->title,0, 3))."-".Str::upper(Str::random(4));
        });
    }

}
