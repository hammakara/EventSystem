<?php

namespace Database\Seeders;

use App\Models\Organizer;
use Illuminate\Database\Seeder;

class OrganizerSeeder extends Seeder
{
    public function run(): void
    {
        Organizer::factory()->count(5)->create();
    }
}
