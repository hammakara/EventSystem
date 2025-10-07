<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch dashboard statistics
        $categories = Category::count();
        $totalEvents = Event::count();
        $activeEvents = Event::where('status', 'active')->count();
        $upcomingEvents = Event::where('start_date', '>', now())->count();
        
        // Calculate revenue (assuming a fixed price per event for demo purposes)
        $revenue = $totalEvents * 1500; // $1500 per event
        // Fetch recent events (limit to 5)
        $recentEvents = Event::with('category')->orderBy('created_at', 'desc')->limit(5)->get();
        // Fetch events for chart (grouped by month for the last 6 months)
        $chartData = $this->getChartData();
        // Fetch recent activity (using events for demo)
        $recentActivity = Event::with('category')->orderBy('updated_at', 'desc')->limit(3)->get();

        return view('pages.admin.dashboard', compact(
            'totalEvents',
            'activeEvents',
            'upcomingEvents',
            'revenue',
            'recentEvents',
            'chartData',
            'recentActivity'
        ));
    }
    
    private function getChartData()
    {
        // Generate sample data for the last 6 months
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('M Y');
            // For demo purposes, generate random event counts
            $eventCount = rand(5, 20);
            $data[] = [
                'month' => $month,
                'events' => $eventCount
            ];
        }
        
        return $data;
    }
}
