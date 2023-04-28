<?php

namespace Database\Factories;

use App\Models\Kind;
use App\Models\Type;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = Fake()->sentence(3);
        return [
            'identifier' => Str::upper(Str::random(4)),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => Fake()->paragraph(3),
            'quantity' => 0,
            'category_id' => Category::all()->random()->id,
            'model_id' => Model::all()->random()->id,
            'brand_id' => Brand::all()->random()->id,
            'kind_id' => Kind::all()->random()->id,
            'type_id' => Type::all()->random()->id,
            'first_image' => Fake()->imageUrl(640, 480, 'cats', true),
            'second_image' => Fake()->imageUrl(640, 480, 'cats', true),
            'third_image' => Fake()->imageUrl(640, 480, 'cats', true),
      //      'statut_id' => 1,
        ];
    }
}
