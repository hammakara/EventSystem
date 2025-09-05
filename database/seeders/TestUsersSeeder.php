<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class TestUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create test users if they don't exist

        // Admin user (already exists, skip)
        
        // Organizer user
        $organizer = User::firstOrCreate([
            'email' => 'organizer@example.com'
        ], [
            'name' => 'Test Organizer',
            'password' => bcrypt('password123'),
        ]);

        // Ensure organizer has the organizer role
        if (!$organizer->hasRole('organizer')) {
            $organizer->assignRole('organizer');
            $this->command->info("Assigned 'organizer' role to {$organizer->name}");
        }

        // Attendee user
        $attendee = User::firstOrCreate([
            'email' => 'attendee@example.com'
        ], [
            'name' => 'Test Attendee',
            'password' => bcrypt('password123'),
        ]);

        // Ensure attendee has the attendee role
        if (!$attendee->hasRole('attendee')) {
            $attendee->assignRole('attendee');
            $this->command->info("Assigned 'attendee' role to {$attendee->name}");
        }

        $this->command->info('Test users created successfully!');
        $this->command->info('Login credentials:');
        $this->command->info('- Organizer: organizer@example.com / password123');
        $this->command->info('- Attendee: attendee@example.com / password123');
    }
}
