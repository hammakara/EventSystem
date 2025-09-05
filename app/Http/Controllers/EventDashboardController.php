<?php

namespace App\Http\Controllers;

use App\Services\CacheService;
use Illuminate\Http\Request;

class EventDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Use CacheService for all dashboard data
        $totals = CacheService::getDashboardTotals();
        $chart = CacheService::getWeeklyRevenue();
        $upcomingEvents = CacheService::getUpcomingEvents(6);
        $topVenues = CacheService::getTopVenues(5);
        $recentAttendees = CacheService::getRecentAttendees(5);

        return view('dashboard.events.index', compact(
            'totals', 
            'chart', 
            'upcomingEvents', 
            'topVenues', 
            'recentAttendees'
        ));
    }
}
