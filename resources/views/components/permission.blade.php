@props(['permission' => null, 'role' => null, 'any' => false])

@php
    $hasAccess = false;
    
    if (auth()->check()) {
        if ($permission && $role) {
            // Check both permission AND role
            $hasAccess = auth()->user()->can($permission) && auth()->user()->hasRole($role);
        } elseif ($permission) {
            // Check permission only
            if ($any && is_array($permission)) {
                // Check if user has ANY of the permissions
                $hasAccess = auth()->user()->hasAnyPermission($permission);
            } else {
                $hasAccess = auth()->user()->can($permission);
            }
        } elseif ($role) {
            // Check role only
            if ($any && is_array($role)) {
                // Check if user has ANY of the roles
                $hasAccess = auth()->user()->hasAnyRole($role);
            } else {
                $hasAccess = auth()->user()->hasRole($role);
            }
        }
    }
@endphp

@if($hasAccess)
    {{ $slot }}
@endif
