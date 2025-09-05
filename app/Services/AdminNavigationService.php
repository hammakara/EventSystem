<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;

class AdminNavigationService
{
    /**
     * Get main navigation items for authenticated users
     */
    public static function getMainNavigation()
    {
        $currentRoute = Route::currentRouteName();
        
        $items = [
            [
                'label' => 'Dashboard',
                'href' => route('dashboard.events'),
                'icon' => 'home',
                'active' => str_starts_with($currentRoute, 'dashboard'),
            ],
            [
                'label' => 'Events',
                'href' => route('events.index'),
                'icon' => 'calendar',
                'active' => str_starts_with($currentRoute, 'events'),
            ],
        ];

        // Add management items for organizers and admins
        if (auth()->check() && auth()->user()->hasAnyRole(['admin', 'organizer'])) {
            $items = array_merge($items, [
                [
                    'label' => 'Organizers',
                    'href' => route('organizers.index'),
                    'icon' => 'user-group',
                    'active' => str_starts_with($currentRoute, 'organizers'),
                ],
                [
                    'label' => 'Venues',
                    'href' => route('venues.index'),
                    'icon' => 'map-pin',
                    'active' => str_starts_with($currentRoute, 'venues'),
                ],
                [
                    'label' => 'Attendees',
                    'href' => route('attendees.index'),
                    'icon' => 'users',
                    'active' => str_starts_with($currentRoute, 'attendees'),
                ],
                [
                    'label' => 'Vendors',
                    'href' => route('vendors.index'),
                    'icon' => 'briefcase',
                    'active' => str_starts_with($currentRoute, 'vendors'),
                ],
            ]);
        }

        return $items;
    }

    /**
     * Get admin-only navigation items
     */
    public static function getAdminNavigation()
    {
        if (!auth()->check() || !auth()->user()->hasRole('admin')) {
            return [];
        }

        $currentRoute = Route::currentRouteName();

        return [
            [
                'label' => 'Admin Dashboard',
                'href' => route('admin.dashboard'),
                'icon' => 'cog-6-tooth',
                'active' => $currentRoute === 'admin.dashboard',
            ],
            [
                'label' => 'User Management',
                'href' => route('users.index'),
                'icon' => 'user-circle',
                'active' => str_starts_with($currentRoute, 'users'),
            ],
            [
                'label' => 'Role Management',
                'href' => route('roles.index'),
                'icon' => 'shield-check',
                'active' => str_starts_with($currentRoute, 'roles'),
            ],
            [
                'label' => 'Analytics',
                'href' => route('admin.analytics'),
                'icon' => 'chart-bar',
                'active' => $currentRoute === 'admin.analytics',
            ],
            [
                'label' => 'System Settings',
                'href' => route('admin.settings'),
                'icon' => 'wrench-screwdriver',
                'active' => $currentRoute === 'admin.settings',
            ],
        ];
    }

    /**
     * Get all navigation items organized by category
     */
    public static function getAllNavigation()
    {
        return [
            'main' => self::getMainNavigation(),
            'admin' => self::getAdminNavigation(),
        ];
    }

    /**
     * Get quick access links for the admin dashboard
     */
    public static function getQuickAccessLinks()
    {
        if (!auth()->check()) {
            return [];
        }
        
        $user = auth()->user();
        $links = [];

        // Basic management links for organizers and admins
        if ($user->hasAnyRole(['admin', 'organizer'])) {
            $links = [
                [
                    'title' => 'Create Event',
                    'description' => 'Add a new event',
                    'href' => route('events.create'),
                    'icon' => 'plus-circle',
                    'color' => 'blue',
                ],
                [
                    'title' => 'Manage Venues',
                    'description' => 'Add or edit venues',
                    'href' => route('venues.index'),
                    'icon' => 'map-pin',
                    'color' => 'green',
                ],
                [
                    'title' => 'View Attendees',
                    'description' => 'Manage attendee list',
                    'href' => route('attendees.index'),
                    'icon' => 'users',
                    'color' => 'purple',
                ],
            ];
        }

        // Admin-specific links
        if ($user->hasRole('admin')) {
            $adminLinks = [
                [
                    'title' => 'User Management',
                    'description' => 'Manage system users',
                    'href' => route('users.index'),
                    'icon' => 'user-circle',
                    'color' => 'red',
                ],
                [
                    'title' => 'Role Management',
                    'description' => 'Configure roles & permissions',
                    'href' => route('roles.index'),
                    'icon' => 'shield-check',
                    'color' => 'yellow',
                ],
                [
                    'title' => 'System Analytics',
                    'description' => 'View reports and insights',
                    'href' => route('admin.analytics'),
                    'icon' => 'chart-bar',
                    'color' => 'indigo',
                ],
                [
                    'title' => 'System Settings',
                    'description' => 'Configure application',
                    'href' => route('admin.settings'),
                    'icon' => 'cog-6-tooth',
                    'color' => 'gray',
                ],
            ];

            $links = array_merge($links, $adminLinks);
        }

        return $links;
    }

    /**
     * Get breadcrumb navigation for current route
     */
    public static function getBreadcrumbs()
    {
        $currentRoute = Route::currentRouteName();
        $breadcrumbs = [
            ['label' => 'Home', 'href' => route('dashboard.events')]
        ];

        $routeMapping = [
            // Admin routes
            'admin.dashboard' => ['Admin Dashboard'],
            'admin.analytics' => ['Admin Dashboard', 'Analytics'],
            'admin.settings' => ['Admin Dashboard', 'Settings'],
            
            // User management
            'users.index' => ['Admin Dashboard', 'Users'],
            'users.create' => ['Admin Dashboard', 'Users', 'Create'],
            'users.show' => ['Admin Dashboard', 'Users', 'View'],
            'users.edit' => ['Admin Dashboard', 'Users', 'Edit'],
            
            // Role management
            'roles.index' => ['Admin Dashboard', 'Roles'],
            'roles.create' => ['Admin Dashboard', 'Roles', 'Create'],
            'roles.show' => ['Admin Dashboard', 'Roles', 'View'],
            'roles.edit' => ['Admin Dashboard', 'Roles', 'Edit'],
            
            // Event management
            'events.index' => ['Events'],
            'events.create' => ['Events', 'Create'],
            'events.show' => ['Events', 'View'],
            'events.edit' => ['Events', 'Edit'],
            
            // Organizer management
            'organizers.index' => ['Organizers'],
            'organizers.create' => ['Organizers', 'Create'],
            'organizers.show' => ['Organizers', 'View'],
            'organizers.edit' => ['Organizers', 'Edit'],
            
            // Venue management
            'venues.index' => ['Venues'],
            'venues.create' => ['Venues', 'Create'],
            'venues.show' => ['Venues', 'View'],
            'venues.edit' => ['Venues', 'Edit'],
            
            // Attendee management
            'attendees.index' => ['Attendees'],
            'attendees.create' => ['Attendees', 'Create'],
            'attendees.show' => ['Attendees', 'View'],
            'attendees.edit' => ['Attendees', 'Edit'],
            
            // Vendor management
            'vendors.index' => ['Vendors'],
            'vendors.create' => ['Vendors', 'Create'],
            'vendors.show' => ['Vendors', 'View'],
            'vendors.edit' => ['Vendors', 'Edit'],
        ];

        if (isset($routeMapping[$currentRoute])) {
            foreach ($routeMapping[$currentRoute] as $i => $label) {
                if ($i === count($routeMapping[$currentRoute]) - 1) {
                    // Last item (current page) - no href
                    $breadcrumbs[] = ['label' => $label];
                } else {
                    // Try to construct route for intermediate items
                    $breadcrumbs[] = ['label' => $label, 'href' => '#'];
                }
            }
        }

        return $breadcrumbs;
    }

    /**
     * Check if user has access to admin features
     */
    public static function hasAdminAccess()
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    /**
     * Check if user has management access (admin or organizer)
     */
    public static function hasManagementAccess()
    {
        return auth()->check() && auth()->user()->hasAnyRole(['admin', 'organizer']);
    }
}
