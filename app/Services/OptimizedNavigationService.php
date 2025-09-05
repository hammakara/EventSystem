<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

class OptimizedNavigationService
{
    /**
     * Get main navigation items with enhanced features
     */
    public static function getMainNavigation()
    {
        $currentRoute = Route::currentRouteName();
        $user = auth()->user();
        
        return Cache::remember("nav_main_{$user?->id}_{$currentRoute}", now()->addMinutes(30), function() use ($currentRoute, $user) {
            $items = [
                [
                    'label' => 'Dashboard',
                    'href' => route('dashboard.events'),
                    'icon' => 'home',
                    'active' => str_starts_with($currentRoute, 'dashboard'),
                    'description' => 'Overview and quick stats',
                    'badge' => null,
                ],
                [
                    'label' => 'Events',
                    'href' => route('events.index'),
                    'icon' => 'calendar-days',
                    'active' => str_starts_with($currentRoute, 'events'),
                    'description' => 'Manage your events',
                    'badge' => self::getEventsBadge(),
                    'submenu' => self::getEventsSubmenu($currentRoute),
                ],
            ];

            // Add role-specific items
            if ($user?->hasAnyRole(['admin', 'organizer'])) {
                $items = array_merge($items, [
                    [
                        'label' => 'Attendees',
                        'href' => route('attendees.index'),
                        'icon' => 'users',
                        'active' => str_starts_with($currentRoute, 'attendees'),
                        'description' => 'Manage attendee registrations',
                        'badge' => self::getAttendeesBadge(),
                    ],
                    [
                        'label' => 'Venues',
                        'href' => route('venues.index'),
                        'icon' => 'map-pin',
                        'active' => str_starts_with($currentRoute, 'venues'),
                        'description' => 'Manage event locations',
                        'badge' => null,
                        'submenu' => [
                            [
                                'label' => 'All Venues',
                                'href' => route('venues.index'),
                                'active' => $currentRoute === 'venues.index',
                            ],
                            [
                                'label' => 'Add Venue',
                                'href' => route('venues.create'),
                                'active' => $currentRoute === 'venues.create',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Organizers',
                        'href' => route('organizers.index'),
                        'icon' => 'user-group',
                        'active' => str_starts_with($currentRoute, 'organizers'),
                        'description' => 'Event organizer management',
                        'badge' => null,
                    ],
                    [
                        'label' => 'Vendors',
                        'href' => route('vendors.index'),
                        'icon' => 'briefcase',
                        'active' => str_starts_with($currentRoute, 'vendors'),
                        'description' => 'Service provider management',
                        'badge' => null,
                    ],
                ]);
            }

            return $items;
        });
    }

    /**
     * Get admin navigation items with enhanced features
     */
    public static function getAdminNavigation()
    {
        $user = auth()->user();
        
        if (!$user?->hasRole('admin')) {
            return [];
        }

        $currentRoute = Route::currentRouteName();
        
        return Cache::remember("nav_admin_{$user->id}_{$currentRoute}", now()->addMinutes(30), function() use ($currentRoute) {
            return [
                [
                    'label' => 'Admin Dashboard',
                    'href' => route('admin.dashboard'),
                    'icon' => 'cog-6-tooth',
                    'active' => $currentRoute === 'admin.dashboard',
                    'description' => 'Administrative overview',
                    'badge' => null,
                ],
                [
                    'label' => 'User Management',
                    'href' => route('users.index'),
                    'icon' => 'user-circle',
                    'active' => str_starts_with($currentRoute, 'users'),
                    'description' => 'Manage system users',
                    'badge' => self::getPendingUsersBadge(),
                ],
                [
                    'label' => 'Roles & Permissions',
                    'href' => route('roles.index'),
                    'icon' => 'shield-check',
                    'active' => str_starts_with($currentRoute, 'roles') || str_starts_with($currentRoute, 'permissions'),
                    'description' => 'Access control management',
                    'badge' => null,
                ],
                [
                    'label' => 'System Analytics',
                    'href' => route('admin.analytics'),
                    'icon' => 'chart-bar-square',
                    'active' => $currentRoute === 'admin.analytics',
                    'description' => 'Reports and insights',
                    'badge' => null,
                ],
                [
                    'label' => 'System Settings',
                    'href' => route('admin.settings'),
                    'icon' => 'wrench-screwdriver',
                    'active' => $currentRoute === 'admin.settings',
                    'description' => 'Application configuration',
                    'badge' => self::getSettingsBadge(),
                ],
            ];
        });
    }

    /**
     * Get events submenu
     */
    private static function getEventsSubmenu($currentRoute)
    {
        return [
            [
                'label' => 'All Events',
                'href' => route('events.index'),
                'active' => $currentRoute === 'events.index',
            ],
            [
                'label' => 'Create Event',
                'href' => route('events.create'),
                'active' => $currentRoute === 'events.create',
            ],
            [
                'label' => 'Drafts',
                'href' => route('events.index', ['status' => 'draft']),
                'active' => request('status') === 'draft',
            ],
        ];
    }

    /**
     * Get quick stats for sidebar
     */
    public static function getQuickStats()
    {
        $user = auth()->user();
        
        if (!$user) {
            return ['events' => 0, 'attendees' => 0];
        }

        return Cache::remember("sidebar_stats_{$user->id}", now()->addMinutes(15), function() use ($user) {
            $stats = ['events' => 0, 'attendees' => 0];
            
            try {
                if ($user->hasRole('admin')) {
                    $stats['events'] = \App\Models\Event::count();
                    $stats['attendees'] = \App\Models\User::whereHas('roles', function($query) {
                        $query->where('name', 'attendee');
                    })->count();
                } elseif ($user->hasRole('organizer')) {
                    $stats['events'] = \App\Models\Event::where('created_by', $user->id)->count();
                    $stats['attendees'] = \App\Models\EventRegistration::whereHas('event', function($query) use ($user) {
                        $query->where('created_by', $user->id);
                    })->count();
                }
            } catch (\Exception $e) {
                // Fallback to 0 if models don't exist yet
                logger()->warning('Could not load sidebar stats: ' . $e->getMessage());
            }
            
            return $stats;
        });
    }

    /**
     * Get all navigation organized by category
     */
    public static function getAllNavigation()
    {
        return [
            'main' => self::getMainNavigation(),
            'admin' => self::getAdminNavigation(),
        ];
    }

    /**
     * Get enhanced quick access links
     */
    public static function getQuickAccessLinks()
    {
        $user = auth()->user();
        
        if (!$user) {
            return [];
        }

        return Cache::remember("quick_access_{$user->id}", now()->addMinutes(30), function() use ($user) {
            $links = [];

            if ($user->hasAnyRole(['admin', 'organizer'])) {
                $links = [
                    [
                        'title' => 'Create Event',
                        'description' => 'Start organizing a new event',
                        'href' => route('events.create'),
                        'icon' => 'plus-circle',
                        'color' => 'blue',
                        'shortcut' => 'Ctrl+N',
                    ],
                    [
                        'title' => 'Event Analytics',
                        'description' => 'View performance metrics',
                        'href' => route('dashboard.events') . '?tab=analytics',
                        'icon' => 'chart-bar',
                        'color' => 'green',
                        'shortcut' => null,
                    ],
                    [
                        'title' => 'Manage Venues',
                        'description' => 'Add or edit event locations',
                        'href' => route('venues.index'),
                        'icon' => 'map-pin',
                        'color' => 'purple',
                        'shortcut' => null,
                    ],
                ];
            }

            if ($user->hasRole('admin')) {
                $adminLinks = [
                    [
                        'title' => 'User Management',
                        'description' => 'Manage system users and roles',
                        'href' => route('users.index'),
                        'icon' => 'user-circle',
                        'color' => 'red',
                        'shortcut' => null,
                    ],
                    [
                        'title' => 'System Health',
                        'description' => 'Monitor application status',
                        'href' => route('admin.settings') . '?tab=health',
                        'icon' => 'heart',
                        'color' => 'pink',
                        'shortcut' => null,
                    ],
                ];

                $links = array_merge($links, $adminLinks);
            }

            return $links;
        });
    }

    /**
     * Get contextual breadcrumbs
     */
    public static function getBreadcrumbs()
    {
        $currentRoute = Route::currentRouteName();
        $breadcrumbs = [
            ['label' => 'Home', 'href' => route('dashboard.events')]
        ];

        $routeMapping = [
            // Dashboard routes
            'dashboard.events' => [],
            
            // Admin routes
            'admin.dashboard' => ['Administration'],
            'admin.analytics' => ['Administration', 'Analytics'],
            'admin.settings' => ['Administration', 'Settings'],
            
            // User management
            'users.index' => ['Administration', 'Users'],
            'users.create' => ['Administration', 'Users', 'Create User'],
            'users.show' => ['Administration', 'Users', 'User Details'],
            'users.edit' => ['Administration', 'Users', 'Edit User'],
            
            // Role management
            'roles.index' => ['Administration', 'Roles & Permissions'],
            'roles.create' => ['Administration', 'Roles & Permissions', 'Create Role'],
            'roles.show' => ['Administration', 'Roles & Permissions', 'Role Details'],
            'roles.edit' => ['Administration', 'Roles & Permissions', 'Edit Role'],
            
            // Event management
            'events.index' => ['Events'],
            'events.create' => ['Events', 'Create Event'],
            'events.show' => ['Events', 'Event Details'],
            'events.edit' => ['Events', 'Edit Event'],
            
            // Other entities...
            'attendees.index' => ['Attendees'],
            'venues.index' => ['Venues'],
            'organizers.index' => ['Organizers'],
            'vendors.index' => ['Vendors'],
        ];

        if (isset($routeMapping[$currentRoute])) {
            foreach ($routeMapping[$currentRoute] as $i => $label) {
                if ($i === count($routeMapping[$currentRoute]) - 1) {
                    $breadcrumbs[] = ['label' => $label];
                } else {
                    $breadcrumbs[] = ['label' => $label, 'href' => '#'];
                }
            }
        }

        return $breadcrumbs;
    }

    /**
     * Helper methods for badges
     */
    private static function getEventsBadge()
    {
        try {
            $upcomingCount = \App\Models\Event::where('scheduled_at', '>', now())
                ->where('status', 'published')
                ->count();
            return $upcomingCount > 0 ? $upcomingCount : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private static function getAttendeesBadge()
    {
        try {
            $pendingCount = \App\Models\EventRegistration::where('status', 'pending')->count();
            return $pendingCount > 0 ? $pendingCount : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private static function getPendingUsersBadge()
    {
        try {
            $pendingCount = \App\Models\User::where('email_verified_at', null)->count();
            return $pendingCount > 0 ? $pendingCount : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private static function getSettingsBadge()
    {
        // Could indicate pending system updates or configuration issues
        return null;
    }

    /**
     * Check permissions
     */
    public static function hasAdminAccess()
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    public static function hasManagementAccess()
    {
        return auth()->check() && auth()->user()->hasAnyRole(['admin', 'organizer']);
    }

    /**
     * Clear navigation cache
     */
    public static function clearCache($userId = null)
    {
        if ($userId) {
            Cache::forget("nav_main_{$userId}_" . Route::currentRouteName());
            Cache::forget("nav_admin_{$userId}_" . Route::currentRouteName());
            Cache::forget("sidebar_stats_{$userId}");
            Cache::forget("quick_access_{$userId}");
        } else {
            Cache::flush(); // Use carefully in production
        }
    }

    /**
     * Get keyboard shortcuts
     */
    public static function getKeyboardShortcuts()
    {
        return [
            'ctrl+b' => 'Toggle sidebar',
            'ctrl+n' => 'Create new event',
            'ctrl+d' => 'Go to dashboard',
            'ctrl+/' => 'Show help',
            '?' => 'Show all shortcuts',
        ];
    }
}
