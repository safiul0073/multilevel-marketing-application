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
    public function definition()
    {
        $category = Category::factory()->create();

        return [
            'category_id' => $category->id,
            'name' => fake()->name(),
            'slug' => 'product_slug',
            'sku'  => random_int(1000000,9999999),
            'description' => fake()->text(),
            'refferral_commission' => rand(20, 30),
            'price' => rand(5000, 10000),
            'video_url' => 'https://www.youtube.com/watch?v=b9kSKlxY3_8&list=RDQvtA4z9yzqM&index=11',
            'status' => 1,
            'is_package' => 1
        ];
    }
}
