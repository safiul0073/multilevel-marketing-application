<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Epin>
 */
class EpinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type'  => fake()->userName(),
            'code'  => rand(50000, 66600),
            'cost'  => rand(50000, 66600),
        ];
    }
}
