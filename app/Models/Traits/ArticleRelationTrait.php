<?php
namespace App\Models\Traits;

use App\Models\Article;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ArticleRelationTrait
{
  public function articles() : HasMany
  {
      return $this->hasMany(Article::class);
  }

}
