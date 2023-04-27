<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'identifier' => "STK-".substr($this->faker->sentence(3), 0, 3).time(),
            'article_id' => null,
            'quantity_stoked' => $this->faker->numberBetween(1, 100),
        ];
    }
}
