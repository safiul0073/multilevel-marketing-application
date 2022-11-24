<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create();
        $cats = \App\Models\Category::factory(10)->create();

        foreach ($cats as $cat) {
            \App\Models\Product::factory()->create([
                'category_id' => $cat->id,
            ]);
        }
    }
}
