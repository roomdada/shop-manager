<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

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


    public function stock() : BelongsTo
    {
        return $this->belongsTo(Stock::class);
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

    public function scopeSort($query, array $sort)
    {
        $query->when($sort['field'] ?? false, function ($query, $field) use ($sort) {
            $query->orderBy($field, $sort['order'] ?? 'asc');
        });
    }
}
