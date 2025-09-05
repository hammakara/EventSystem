<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DebugPermissions extends Command
{
    protected $signature = 'debug:permissions';
    protected $description = 'Debug permission assignments';

    public function handle()
    {
        $this->info('=== Permission System Overview ===');
        
        // Show all permissions grouped
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });
        
        $this->info('Permission Groups:');
        foreach ($permissions as $group => $groupPermissions) {
            $this->line("  📁 {$group}: {$groupPermissions->count()} permissions");
            foreach ($groupPermissions as $permission) {
                $roleCount = $permission->roles->count();
                $this->line("    - {$permission->name} ({$roleCount} roles)");
            }
        }

        $this->line('');
        
        // Show roles and their permissions
        $roles = Role::with('permissions')->get();
        $this->info('Role Permissions:');
        foreach ($roles as $role) {
            $this->line("  🔑 {$role->name}: {$role->permissions->count()} permissions");
            
            $groupedRolePerms = $role->permissions->groupBy(function ($permission) {
                return explode('.', $permission->name)[0];
            });
            
            foreach ($groupedRolePerms as $group => $perms) {
                $this->line("    📂 {$group}: " . $perms->pluck('name')->map(function($name) {
                    return explode('.', $name)[1];
                })->join(', '));
            }
        }

        return 0;
    }
}
