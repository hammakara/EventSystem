<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ClientEventController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
        $type = trim((string) $request->query('type', ''));
        $venue = trim((string) $request->query('venue', ''));
        $organizer = trim((string) $request->query('organizer', ''));
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $sort = (string) $request->query('sort', 'date_asc');
        $status = (string) $request->query('status', 'all'); // all | upcoming | past

        $query = Event::query()
            ->with(['organizer:id,name', 'venue:id,name,address']);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('organizer', function ($oq) use ($search) {
                      $oq->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('venue', function ($vq) use ($search) {
                      $vq->where('name', 'like', "%{$search}%")
                         ->orWhere('address', 'like', "%{$search}%");
                  });
            });
        }

        if ($type !== '') {
            $query->where('type', $type);
        }

        if ($venue !== '') {
            $query->whereHas('venue', function ($q) use ($venue) {
                $q->where('name', 'like', "%{$venue}%")
                  ->orWhere('address', 'like', "%{$venue}%");
            });
        }

        if ($organizer !== '') {
            $query->whereHas('organizer', function ($q) use ($organizer) {
                $q->where('name', 'like', "%{$organizer}%");
            });
        }

        if (!empty($startDate)) {
            try {
                $start = Carbon::parse($startDate)->startOfDay();
                $query->where('scheduled_at', '>=', $start);
            } catch (\Throwable $e) {
                // ignore invalid date
            }
        }

        if (!empty($endDate)) {
            try {
                $end = Carbon::parse($endDate)->endOfDay();
                $query->where('scheduled_at', '<=', $end);
            } catch (\Throwable $e) {
                // ignore invalid date
            }
        }

        if ($status === 'upcoming') {
            $query->where('scheduled_at', '>=', now());
        } elseif ($status === 'past') {
            $query->where('scheduled_at', '<', now());
        }

        switch ($sort) {
            case 'date_desc':
                $query->orderByDesc('scheduled_at');
                break;
            case 'title_asc':
                $query->orderBy('title');
                break;
            case 'title_desc':
                $query->orderByDesc('title');
                break;
            case 'date_asc':
            default:
                $query->orderBy('scheduled_at');
                break;
        }

        $types = Event::query()->select('type')->distinct()->orderBy('type')->pluck('type');

        // Counts for hero pills
        $counts = [
            'all' => Event::count(),
            'upcoming' => Event::where('scheduled_at', '>=', now())->count(),
            'past' => Event::where('scheduled_at', '<', now())->count(),
        ];

        // Popular types (by frequency)
        $popularTypes = Event::query()
            ->select('type')
            ->selectRaw('COUNT(*) as c')
            ->groupBy('type')
            ->orderByDesc('c')
            ->limit(6)
            ->pluck('type');

        $events = $query->paginate(12)->withQueryString();

        return view('client.events.index', [
            'events' => $events,
            'types' => $types,
            'status' => $status,
            'counts' => $counts,
            'popularTypes' => $popularTypes,
        ]);
    }

    public function show(Event $event)
    {
        $event->load(['organizer', 'venue', 'attendees', 'vendors']);
        return view('client.events.show', compact('event'));
    }
}

