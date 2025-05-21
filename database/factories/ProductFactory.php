<?php

namespace Database\Factories;

use App\Models\Category;
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
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->numberBetween(500, 5000), // em centavos, por exemplo
            'image' => $this->faker->imageUrl(640, 480, 'food', true, 'produto'),
            'category_id' => Category::factory(), // se tiver relacionamento
        ];
    }
}
