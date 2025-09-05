<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions grouped by resource
        $permissions = [
            // User Management
            'users.view' => 'View users',
            'users.create' => 'Create users',
            'users.edit' => 'Edit users', 
            'users.delete' => 'Delete users',

            // Role & Permission Management
            'roles.view' => 'View roles',
            'roles.create' => 'Create roles',
            'roles.edit' => 'Edit roles',
            'roles.delete' => 'Delete roles',
            'permissions.view' => 'View permissions',
            'permissions.assign' => 'Assign permissions',

            // Event Management
            'events.view' => 'View events',
            'events.create' => 'Create events',
            'events.edit' => 'Edit events',
            'events.delete' => 'Delete events',
            'events.publish' => 'Publish events',

            // Organizer Management
            'organizers.view' => 'View organizers',
            'organizers.create' => 'Create organizers',
            'organizers.edit' => 'Edit organizers',
            'organizers.delete' => 'Delete organizers',

            // Venue Management
            'venues.view' => 'View venues',
            'venues.create' => 'Create venues',
            'venues.edit' => 'Edit venues',
            'venues.delete' => 'Delete venues',

            // Attendee Management
            'attendees.view' => 'View attendees',
            'attendees.create' => 'Create attendees',
            'attendees.edit' => 'Edit attendees',
            'attendees.delete' => 'Delete attendees',

            // Vendor Management
            'vendors.view' => 'View vendors',
            'vendors.create' => 'Create vendors',
            'vendors.edit' => 'Edit vendors',
            'vendors.delete' => 'Delete vendors',

            // Dashboard Access
            'dashboard.admin' => 'Access admin dashboard',
            'dashboard.events' => 'Access events dashboard',
            'dashboard.analytics' => 'View analytics',

            // System Settings
            'settings.view' => 'View system settings',
            'settings.edit' => 'Edit system settings',
            'cache.clear' => 'Clear system cache',

            // Reports
            'reports.view' => 'View reports',
            'reports.export' => 'Export reports',
        ];

        // Create all permissions
        foreach ($permissions as $name => $description) {
            Permission::create([
                'name' => $name,
                'guard_name' => 'web',
            ]);
        }

        $this->command->info('Created ' . count($permissions) . ' permissions');

        // Assign permissions to roles
        $this->assignPermissionsToRoles();
    }

    private function assignPermissionsToRoles(): void
    {
        // Admin gets all permissions
        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo(Permission::all());
        $this->command->info('Assigned all permissions to admin role');

        // Organizer permissions
        $organizerRole = Role::findByName('organizer');
        $organizerPermissions = [
            // Event management
            'events.view', 'events.create', 'events.edit', 'events.delete', 'events.publish',
            
            // Their own organizer profile
            'organizers.view', 'organizers.edit',
            
            // Venue management (they need venues for events)
            'venues.view', 'venues.create', 'venues.edit',
            
            // Attendee management for their events
            'attendees.view', 'attendees.create', 'attendees.edit',
            
            // Vendor management for their events
            'vendors.view', 'vendors.create', 'vendors.edit',
            
            // Dashboard access
            'dashboard.events',
            
            // Basic reports
            'reports.view',
        ];
        
        $organizerRole->givePermissionTo($organizerPermissions);
        $this->command->info('Assigned ' . count($organizerPermissions) . ' permissions to organizer role');

        // Attendee permissions (very limited)
        $attendeeRole = Role::findByName('attendee');
        $attendeePermissions = [
            'events.view',  // Can view public events
        ];
        
        $attendeeRole->givePermissionTo($attendeePermissions);
        $this->command->info('Assigned ' . count($attendeePermissions) . ' permissions to attendee role');
    }
}
