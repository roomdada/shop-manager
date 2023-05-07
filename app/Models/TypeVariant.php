<?php

namespace App\Models;

use App\Models\Traits\FormatDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVariant extends Model
{
    use HasFactory, FormatDateTrait;

    protected $guarded = [];


}
