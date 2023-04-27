<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Model;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Brand::create([
            'wording' => 'Audi',
            'slug' => 'audi',
            'description' => 'Audi AG is a German automobile manufacturer that designs, engineers, produces, markets and distributes luxury vehicles.',
        ]);

        Brand::create([
            'wording' => 'BMW',
            'slug' => 'bmw',
            'description' => 'Bayerische Motoren Werke AG, commonly known as BMW or BMW AG, is a German multinational company which produces automobiles and motorcycles.',
        ]);

        Brand::create([
            'wording' => 'Mercedes-Benz',
            'slug' => 'mercedes-benz',
            'description' => 'Mercedes-Benz is a German global automobile marque and a division of Daimler AG. The brand is known for luxury vehicles, buses, coaches, and trucks.',
        ]);

        Model::create([
            'wording' => 'Model 1',
            'slug' => 'model-1',
        ]);

        Model::create([
            'wording' => 'Model 2',
            'slug' => 'model-2',
        ]);

    for($i = 0; $i < 30; $i++){
        Category::create([
            'title' => 'Category '.$i,
            'slug' => 'category-'.$i,
        ]);
      }
    }
}
