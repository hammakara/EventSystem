<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions for user management
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage user roles',
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'manage permissions',
            'view system settings',
            'manage system settings',
        ];

        // Create permissions if they don't exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign all permissions to admin role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);

        // Assign limited permissions to organizer role
        $organizerRole = Role::firstOrCreate(['name' => 'organizer']);
        $organizerRole->syncPermissions([
            'view users',
        ]);

        // Attendee role gets no admin permissions
        Role::firstOrCreate(['name' => 'attendee']);
    }
}
