<?php

namespace App\Models;

use App\Models\Traits\SluggableTrait;
use App\Models\Traits\FormatDateTrait;
use App\Models\Traits\ArticleRelationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
  use HasFactory, ArticleRelationTrait, FormatDateTrait, SluggableTrait;

  protected $guarded = [];

}
