<?php
namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait FormatDateTrait
{
    public function createdAt() : Attribute
    {
        return new Attribute(
           get : fn() => \Carbon\Carbon::parse($this->attributes['created_at'])->format('d/m/Y')
        );
    }

}
