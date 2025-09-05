<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class FixUserRoles extends Command
{
    protected $signature = 'fix:user-roles {email} {role}';
    protected $description = 'Assign or fix a role for a specific user';

    public function handle()
    {
        $email = $this->argument('email');
        $roleName = $this->argument('role');

        // Find user
        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }

        // Check if role exists
        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            $this->error("Role '{$roleName}' does not exist.");
            $this->info("Available roles: " . Role::pluck('name')->join(', '));
            return 1;
        }

        // Check if user already has the role
        if ($user->hasRole($roleName)) {
            $this->warn("User {$user->name} already has the '{$roleName}' role.");
        } else {
            // Assign the role
            $user->assignRole($roleName);
            $this->info("Successfully assigned '{$roleName}' role to {$user->name} ({$email}).");
        }

        // Show current roles
        $currentRoles = $user->roles->pluck('name')->join(', ');
        $this->info("User's current roles: {$currentRoles}");

        return 0;
    }
}
