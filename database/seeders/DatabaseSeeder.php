<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
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
        \App\Models\TaskScheduler::create([
            'title' => "matching",
            'date_time' => geMatchingSchedulerDateTime()
        ]);
        $cats = \App\Models\Category::factory(10)->create();

        foreach ($cats as $cat) {
            \App\Models\Product::factory()->create([
                'category_id' => $cat->id,
            ]);
        }
    }
}
