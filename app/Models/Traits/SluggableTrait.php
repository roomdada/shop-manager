<?php
namespace App\Models\Traits;

use Cviebrock\EloquentSluggable\Sluggable;

trait SluggableTrait
{
  use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => isset($this->attributes['wording'])  ? 'wording' : 'title'
            ]
        ];
    }
}
