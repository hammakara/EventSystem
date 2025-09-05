<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RolesAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles if not exist
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $organizer = Role::firstOrCreate(['name' => 'organizer']);
        $attendee = Role::firstOrCreate(['name' => 'attendee']);

        // Create a default admin user (for development)
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // Change in production
            ]
        );

        if (!$user->hasRole('admin')) {
            $user->assignRole($admin);
        }
    }
}

