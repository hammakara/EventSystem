<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class DebugUserRoles extends Command
{
    protected $signature = 'debug:user-roles {email?}';
    protected $description = 'Debug user role assignments';

    public function handle()
    {
        $email = $this->argument('email');

        if ($email) {
            $this->debugSpecificUser($email);
        } else {
            $this->debugAllUsers();
        }

        return 0;
    }

    private function debugSpecificUser($email)
    {
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found.");
            return;
        }

        $this->info("=== User Debug: {$user->name} ({$user->email}) ===");
        $this->line("User ID: {$user->id}");
        
        $roles = $user->roles;
        if ($roles->count() > 0) {
            $this->info("Roles assigned:");
            foreach ($roles as $role) {
                $this->line("  - {$role->name} (ID: {$role->id})");
            }

            // Test role checking methods
            $this->info("Role checks:");
            $this->line("  - hasRole('admin'): " . ($user->hasRole('admin') ? 'YES' : 'NO'));
            $this->line("  - hasRole('organizer'): " . ($user->hasRole('organizer') ? 'YES' : 'NO'));
            $this->line("  - hasRole('attendee'): " . ($user->hasRole('attendee') ? 'YES' : 'NO'));
            $this->line("  - hasAnyRole(['admin', 'organizer']): " . ($user->hasAnyRole(['admin', 'organizer']) ? 'YES' : 'NO'));
        } else {
            $this->warn("No roles assigned to this user!");
        }
    }

    private function debugAllUsers()
    {
        $this->info("=== All Users and Their Roles ===");
        
        // Show all available roles first
        $roles = Role::all();
        $this->info("Available roles:");
        foreach ($roles as $role) {
            $userCount = User::role($role->name)->count();
            $this->line("  - {$role->name}: {$userCount} users");
        }

        $this->line("");

        // Show users by role
        foreach ($roles as $role) {
            $users = User::role($role->name)->get();
            if ($users->count() > 0) {
                $this->info("Users with '{$role->name}' role:");
                foreach ($users as $user) {
                    $allRoles = $user->roles->pluck('name')->join(', ');
                    $this->line("  - {$user->name} ({$user->email}) - Roles: {$allRoles}");
                }
                $this->line("");
            }
        }

        // Show users without any roles
        $usersWithoutRoles = User::doesntHave('roles')->get();
        if ($usersWithoutRoles->count() > 0) {
            $this->warn("Users without any roles:");
            foreach ($usersWithoutRoles as $user) {
                $this->line("  - {$user->name} ({$user->email})");
            }
        }
    }
}
