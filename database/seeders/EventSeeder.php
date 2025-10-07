<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories first
        $categories = Category::factory()->count(5)->create();

        // Create events
        Event::factory()->count(20)->create([
            'category_id' => $categories->random()->id,
        ]);
    }
}
