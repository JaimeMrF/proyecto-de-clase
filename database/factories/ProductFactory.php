<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use League\CommonMark\Reference\Reference;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(500,1000),
            'category_id' => fake()->numberBetween(1,3)
        ];
    }
}
