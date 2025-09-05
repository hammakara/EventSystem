<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Venue;
use App\Models\Organizer;
use App\Models\Attendee;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function __construct()
    {
        // This will be handled by route middleware
    }

    /**
     * Show the admin dashboard with overview statistics
     */
    public function index()
    {
        // Cache the dashboard stats for better performance
        $stats = Cache::remember('admin.dashboard.stats', now()->addMinutes(15), function () {
            return [
                'total_users' => User::count(),
                'total_events' => Event::count(),
                'total_venues' => Venue::count(),
                'total_organizers' => Organizer::count(),
                'total_attendees' => Attendee::count(),
                'total_vendors' => Vendor::count(),
                'total_roles' => Role::count(),
                'total_permissions' => Permission::count(),
                
                // Recent activity
                'recent_users' => User::latest()->take(5)->get(),
                'recent_events' => Event::with('organizer')->latest()->take(5)->get(),
                'recent_registrations' => Attendee::latest()->take(5)->get(),
                
                // Status counts
                'active_events' => Event::where('scheduled_at', '>=', now())->count(),
                'past_events' => Event::where('scheduled_at', '<', now())->count(),
                'admin_users' => User::role('admin')->count(),
                'organizer_users' => User::role('organizer')->count(),
                'attendee_users' => User::role('attendee')->count(),
            ];
        });

        return view('admin.dashboard.index', compact('stats'));
    }

    /**
     * Show system settings and configuration
     */
    public function settings()
    {
        $roles = Role::withCount('users')->get();
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode(' ', $permission->name)[1] ?? 'general';
        });

        return view('admin.settings.index', compact('roles', 'permissions'));
    }

    /**
     * Show system analytics and reports
     */
    public function analytics()
    {
        // Comprehensive analytics data
        $analytics = [
            'user_growth' => $this->getUserGrowthData(),
            'event_statistics' => $this->getEventStatistics(),
            'popular_venues' => $this->getPopularVenues(),
            'organizer_performance' => $this->getOrganizerPerformance(),
            'attendee_engagement' => $this->getAttendeeEngagement(),
        ];

        return view('admin.analytics.index', compact('analytics'));
    }

    /**
     * Clear application cache
     */
    public function clearCache()
    {
        Cache::flush();
        
        return redirect()->back()->with('success', 'Application cache cleared successfully.');
    }

    /**
     * Get user growth data for charts
     */
    private function getUserGrowthData()
    {
        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months->push([
                'month' => $date->format('M Y'),
                'users' => User::whereYear('created_at', $date->year)
                             ->whereMonth('created_at', $date->month)
                             ->count()
            ]);
        }
        
        return $months;
    }

    /**
     * Get event statistics
     */
    private function getEventStatistics()
    {
        // SQLite-compatible date functions
        $monthQuery = config('database.default') === 'sqlite' 
            ? "CAST(strftime('%m', scheduled_at) AS INTEGER) as month, CAST(strftime('%Y', scheduled_at) AS INTEGER) as year, COUNT(*) as count"
            : 'MONTH(scheduled_at) as month, YEAR(scheduled_at) as year, COUNT(*) as count';
            
        return [
            'by_month' => Event::selectRaw($monthQuery)
                              ->where('scheduled_at', '>=', now()->subYear())
                              ->groupBy('year', 'month')
                              ->orderBy('year')
                              ->orderBy('month')
                              ->get(),
            'by_status' => [
                'upcoming' => Event::where('scheduled_at', '>', now())->count(),
                'ongoing' => Event::whereDate('scheduled_at', now())->count(),
                'completed' => Event::where('scheduled_at', '<', now())->count(),
            ],
        ];
    }

    /**
     * Get popular venues
     */
    private function getPopularVenues()
    {
        return Venue::withCount('events')
                   ->orderBy('events_count', 'desc')
                   ->take(10)
                   ->get();
    }

    /**
     * Get organizer performance data
     */
    private function getOrganizerPerformance()
    {
        return Organizer::withCount(['events', 'events as upcoming_events' => function ($query) {
                         $query->where('scheduled_at', '>', now());
                     }])
                     ->orderBy('events_count', 'desc')
                     ->take(10)
                     ->get();
    }

    /**
     * Get attendee engagement metrics
     */
    private function getAttendeeEngagement()
    {
        // Calculate average events per attendee in a SQLite-compatible way
        $totalRegistrations = \DB::table('attendee_event')->count();
        $totalAttendees = \DB::table('attendee_event')->distinct('attendee_id')->count();
        $avgEventsPerAttendee = $totalAttendees > 0 ? $totalRegistrations / $totalAttendees : 0;
        
        return [
            'total_registrations' => $totalRegistrations,
            'avg_events_per_attendee' => round($avgEventsPerAttendee, 2),
            'most_active_attendees' => Attendee::withCount('events')
                                              ->orderBy('events_count', 'desc')
                                              ->take(10)
                                              ->get(),
        ];
    }
}
