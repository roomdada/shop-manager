<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Type::create([
            'wording' => 'Occassion',
            'slug' => 'occassion',
        ]);

        Type::create([
            'wording' => 'Neuf',
            'slug' => 'neuf',
        ]);

    }
}
