<?php

namespace Database\Factories\Api;

use App\Models\Api\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\Product>
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
        $category = Category::factory(1)->create();
        return [
            'name' => ucfirst(fake()->word()),
            'price' => fake()->numberBetween(100, 1000), // preço entre R$1,00 e R$10,00
            'category_id' => $category->id,
        ];
    }
}
