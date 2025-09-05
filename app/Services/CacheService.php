<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Venue;
use App\Models\Attendee;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheService
{
    // Cache keys
    const DASHBOARD_TOTALS = 'dashboard.totals';
    const DASHBOARD_REVENUE = 'dashboard.revenue.';
    const UPCOMING_EVENTS = 'dashboard.upcoming_events';
    const TOP_VENUES = 'dashboard.top_venues';
    const RECENT_ATTENDEES = 'dashboard.recent_attendees';
    const VENUE_OPTIONS = 'select.venues';
    const ORGANIZER_OPTIONS = 'select.organizers';

    // Cache durations (in seconds)
    const SHORT_CACHE = 300;    // 5 minutes
    const MEDIUM_CACHE = 1800;  // 30 minutes
    const LONG_CACHE = 3600;    // 1 hour

    /**
     * Get dashboard totals with caching
     */
    public static function getDashboardTotals(): array
    {
        return Cache::remember(self::DASHBOARD_TOTALS, self::SHORT_CACHE, function () {
            $now = now();
            return [
                'events_upcoming' => Event::upcoming()->count(),
                'events_past' => Event::past()->count(),
                'attendees' => Attendee::count(),
                'venues' => \App\Models\Venue::count(),
                'vendors' => \App\Models\Vendor::count(),
                'organizers' => \App\Models\Organizer::count(),
            ];
        });
    }

    /**
     * Get revenue data for the last 7 days
     */
    public static function getWeeklyRevenue(): array
    {
        $today = now()->startOfDay();
        $cacheKey = self::DASHBOARD_REVENUE . $today->toDateString();
        
        return Cache::remember($cacheKey, self::MEDIUM_CACHE, function () use ($today) {
            $start = $today->copy()->subDays(6);
            $end = $today->copy()->endOfDay();
            
            $revenue = DB::table('events')
                ->leftJoin('event_vendor', 'events.id', '=', 'event_vendor.event_id')
                ->whereBetween('scheduled_at', [$start, $end])
                ->selectRaw('date(scheduled_at) as day, COALESCE(sum(event_vendor.fee), 0) as total')
                ->groupBy('day')
                ->orderBy('day')
                ->pluck('total', 'day');

            $days = collect(range(0, 6))->map(fn($i) => $today->copy()->subDays(6 - $i)->toDateString());
            
            return [
                'labels' => $days->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))->values(),
                'series' => $days->map(fn($d) => (float) ($revenue[$d] ?? 0))->values(),
            ];
        });
    }

    /**
     * Get upcoming events for dashboard
     */
    public static function getUpcomingEvents(int $limit = 6): \Illuminate\Database\Eloquent\Collection
    {
        return Cache::remember(self::UPCOMING_EVENTS . "_{$limit}", self::MEDIUM_CACHE, function () use ($limit) {
            return Event::select(['id', 'title', 'scheduled_at', 'venue_id', 'organizer_id'])
                ->withBasicRelations()
                ->withCount('attendees')
                ->upcoming()
                ->orderBy('scheduled_at')
                ->limit($limit)
                ->get();
        });
    }

    /**
     * Get top venues by upcoming events count
     */
    public static function getTopVenues(int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return Cache::remember(self::TOP_VENUES . "_{$limit}", self::LONG_CACHE, function () use ($limit) {
            return Venue::select(['id', 'name'])
                ->withCount(['events' => function ($q) {
                    $q->upcoming();
                }])
                ->orderByDesc('events_count')
                ->limit($limit)
                ->get();
        });
    }

    /**
     * Get recent attendees
     */
    public static function getRecentAttendees(int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return Cache::remember(self::RECENT_ATTENDEES . "_{$limit}", self::SHORT_CACHE, function () use ($limit) {
            return Attendee::select(['id', 'name', 'created_at'])
                ->latest()
                ->limit($limit)
                ->get();
        });
    }

    /**
     * Get venues for select options
     */
    public static function getVenueOptions(): \Illuminate\Database\Eloquent\Collection
    {
        return Cache::remember(self::VENUE_OPTIONS, self::LONG_CACHE, function () {
            return Venue::select(['id', 'name'])->orderBy('name')->get();
        });
    }

    /**
     * Get organizers for select options
     */
    public static function getOrganizerOptions(): \Illuminate\Database\Eloquent\Collection
    {
        return Cache::remember(self::ORGANIZER_OPTIONS, self::LONG_CACHE, function () {
            return \App\Models\Organizer::select(['id', 'name'])->orderBy('name')->get();
        });
    }

    /**
     * Clear dashboard-related caches
     */
    public static function clearDashboardCache(): void
    {
        $keys = [
            self::DASHBOARD_TOTALS,
            self::UPCOMING_EVENTS,
            self::TOP_VENUES,
            self::RECENT_ATTENDEES,
        ];

        foreach ($keys as $key) {
            Cache::forget($key);
        }

        // Clear revenue cache for current week
        $today = now()->startOfDay();
        for ($i = 0; $i < 7; $i++) {
            $date = $today->copy()->subDays($i)->toDateString();
            Cache::forget(self::DASHBOARD_REVENUE . $date);
        }
    }

    /**
     * Clear select option caches
     */
    public static function clearSelectOptionCache(): void
    {
        Cache::forget(self::VENUE_OPTIONS);
        Cache::forget(self::ORGANIZER_OPTIONS);
    }

    /**
     * Clear all application caches
     */
    public static function clearAllCache(): void
    {
        self::clearDashboardCache();
        self::clearSelectOptionCache();
    }
}
