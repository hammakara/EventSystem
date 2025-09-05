<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\CacheService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EventController extends Controller
{
    /**
     * Display a paginated list of events with filtering
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min($request->input('per_page', 15), 100); // Max 100 items per page
        $query = Event::withBasicRelations();

        // Apply filters
        if ($request->filled('status')) {
            if ($request->status === 'upcoming') {
                $query->upcoming();
            } elseif ($request->status === 'past') {
                $query->past();
            } elseif ($request->status === 'today') {
                $query->today();
            }
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('organizer_id')) {
            $query->where('organizer_id', $request->organizer_id);
        }

        if ($request->filled('venue_id')) {
            $query->where('venue_id', $request->venue_id);
        }

        // Date range filtering
        if ($request->filled('from_date')) {
            $query->where('scheduled_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->where('scheduled_at', '<=', $request->to_date);
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'scheduled_at');
        $sortDirection = $request->input('sort_direction', 'asc');
        
        $allowedSorts = ['id', 'title', 'scheduled_at', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDirection);
        }

        $events = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $events->items(),
            'pagination' => [
                'current_page' => $events->currentPage(),
                'last_page' => $events->lastPage(),
                'per_page' => $events->perPage(),
                'total' => $events->total(),
                'has_more' => $events->hasMorePages(),
            ],
            'filters_applied' => $request->only(['status', 'search', 'organizer_id', 'venue_id', 'from_date', 'to_date']),
        ]);
    }

    /**
     * Display a single event with full details
     */
    public function show(Event $event): JsonResponse
    {
        $event->loadMissing(['organizer', 'venue', 'attendees', 'vendors']);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $event->id,
                'title' => $event->title,
                'type' => $event->type,
                'scheduled_at' => $event->scheduled_at,
                'image' => $event->image,
                'organizer' => [
                    'id' => $event->organizer->id,
                    'name' => $event->organizer->name,
                    'email' => $event->organizer->email ?? null,
                ],
                'venue' => [
                    'id' => $event->venue->id,
                    'name' => $event->venue->name,
                    'location' => $event->venue->location ?? null,
                    'capacity' => $event->venue->capacity ?? null,
                ],
                'stats' => [
                    'attendees_count' => $event->attendees->count(),
                    'vendors_count' => $event->vendors->count(),
                    'total_revenue' => $event->vendors->sum('pivot.fee') ?? 0,
                ],
                'attendees' => $event->attendees->map(fn($attendee) => [
                    'id' => $attendee->id,
                    'name' => $attendee->name,
                    'contact' => $attendee->contact,
                    'status' => $attendee->pivot->status ?? 'pending',
                ]),
                'vendors' => $event->vendors->map(fn($vendor) => [
                    'id' => $vendor->id,
                    'name' => $vendor->name,
                    'contact' => $vendor->contact ?? null,
                    'service_details' => $vendor->pivot->service_details ?? null,
                    'fee' => $vendor->pivot->fee ?? 0,
                ]),
                'created_at' => $event->created_at,
                'updated_at' => $event->updated_at,
            ]
        ]);
    }

    /**
     * Get dashboard statistics (cached)
     */
    public function dashboard(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'totals' => CacheService::getDashboardTotals(),
                'revenue_chart' => CacheService::getWeeklyRevenue(),
                'upcoming_events' => CacheService::getUpcomingEvents(6),
                'top_venues' => CacheService::getTopVenues(5),
                'recent_attendees' => CacheService::getRecentAttendees(5),
            ]
        ]);
    }

    /**
     * Get select options (cached)
     */
    public function options(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'venues' => CacheService::getVenueOptions(),
                'organizers' => CacheService::getOrganizerOptions(),
                'event_statuses' => [
                    ['value' => 'upcoming', 'label' => 'Upcoming'],
                    ['value' => 'past', 'label' => 'Past'],
                    ['value' => 'today', 'label' => 'Today'],
                ],
                'sort_options' => [
                    ['value' => 'scheduled_at', 'label' => 'Event Date'],
                    ['value' => 'title', 'label' => 'Title'],
                    ['value' => 'created_at', 'label' => 'Created Date'],
                ],
            ]
        ]);
    }

    /**
     * Search events with optimized query
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->input('q', '');
        $limit = min($request->input('limit', 10), 50);

        if (empty($query)) {
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'No search query provided'
            ]);
        }

        $events = Event::select(['id', 'title', 'scheduled_at', 'venue_id', 'organizer_id'])
            ->withBasicRelations()
            ->where('title', 'like', '%' . $query . '%')
            ->orderBy('scheduled_at')
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $events,
            'query' => $query,
            'count' => $events->count()
        ]);
    }
}
