<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'uuid',
        'description'
    ];

    public const ADMIN = 1;
    public const CUSTOMER = 2;

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
