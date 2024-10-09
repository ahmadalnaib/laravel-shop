<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'title' => $this->faker->sentence(3),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'description' => $this->faker->paragraph,
            'category' => $this->faker->word,
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
            'rating_rate' => $this->faker->randomFloat(1, 1, 5),
            'rating_count' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
