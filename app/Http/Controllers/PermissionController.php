<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:permissions.view')->only(['index', 'show']);
        $this->middleware('can:permissions.assign')->only(['assignRole', 'revokeRole', 'assignPermission', 'revokePermission']);
    }

    /**
     * Display permission management overview
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });
        $users = User::with('roles')->get();

        return view('admin.permissions.index', compact('roles', 'permissions', 'users'));
    }

    /**
     * Show role permissions management
     */
    public function showRole(Role $role)
    {
        $role->load('permissions', 'users');
        $allPermissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });

        return view('admin.permissions.role', compact('role', 'allPermissions'));
    }

    /**
     * Show user permissions management
     */
    public function showUser(User $user)
    {
        $user->load('roles', 'permissions');
        $allRoles = Role::all();
        $allPermissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });

        return view('admin.permissions.user', compact('user', 'allRoles', 'allPermissions'));
    }

    /**
     * Assign role to user
     */
    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->assignRole($request->role);

        return response()->json([
            'success' => true,
            'message' => "Role '{$request->role}' assigned to {$user->name}"
        ]);
    }

    /**
     * Revoke role from user
     */
    public function revokeRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->removeRole($request->role);

        return response()->json([
            'success' => true,
            'message' => "Role '{$request->role}' revoked from {$user->name}"
        ]);
    }

    /**
     * Assign permission to role
     */
    public function assignPermissionToRole(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission' => 'required|exists:permissions,name'
        ]);

        $role = Role::findOrFail($request->role_id);
        $role->givePermissionTo($request->permission);

        return response()->json([
            'success' => true,
            'message' => "Permission '{$request->permission}' assigned to role '{$role->name}'"
        ]);
    }

    /**
     * Revoke permission from role
     */
    public function revokePermissionFromRole(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission' => 'required|exists:permissions,name'
        ]);

        $role = Role::findOrFail($request->role_id);
        $role->revokePermissionTo($request->permission);

        return response()->json([
            'success' => true,
            'message' => "Permission '{$request->permission}' revoked from role '{$role->name}'"
        ]);
    }

    /**
     * Assign direct permission to user
     */
    public function assignPermissionToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission' => 'required|exists:permissions,name'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->givePermissionTo($request->permission);

        return response()->json([
            'success' => true,
            'message' => "Permission '{$request->permission}' assigned directly to {$user->name}"
        ]);
    }

    /**
     * Revoke direct permission from user
     */
    public function revokePermissionFromUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission' => 'required|exists:permissions,name'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->revokePermissionTo($request->permission);

        return response()->json([
            'success' => true,
            'message' => "Permission '{$request->permission}' revoked from {$user->name}"
        ]);
    }

    /**
     * Get user permissions summary
     */
    public function getUserPermissions(User $user)
    {
        $rolePermissions = $user->getPermissionsViaRoles();
        $directPermissions = $user->getDirectPermissions();
        $allPermissions = $user->getAllPermissions();

        return response()->json([
            'role_permissions' => $rolePermissions->pluck('name'),
            'direct_permissions' => $directPermissions->pluck('name'),
            'all_permissions' => $allPermissions->pluck('name')
        ]);
    }

    /**
     * Get role permissions
     */
    public function getRolePermissions(Role $role)
    {
        return response()->json([
            'permissions' => $role->permissions->pluck('name')
        ]);
    }
}
