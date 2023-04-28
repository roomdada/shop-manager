<?php

namespace App\Models;

use App\Models\Traits\SluggableTrait;
use App\Models\Traits\FormatDateTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\ArticleRelationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory, ArticleRelationTrait, FormatDateTrait, SluggableTrait;

    protected $guarded = [];
}
