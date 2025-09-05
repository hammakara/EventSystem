<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use App\Models\Venue;
use App\Services\CacheService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::withBasicRelations();
        
        // Add filtering
        if ($request->filled('status')) {
            if ($request->status === 'upcoming') {
                $query->upcoming();
            } elseif ($request->status === 'past') {
                $query->past();
            }
        }
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        $events = $query->latest('scheduled_at')->paginate(12);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $organizers = CacheService::getOrganizerOptions();
        $venues = CacheService::getVenueOptions();
        return view('events.create', compact('organizers','venues'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:120',
            'scheduled_at' => 'required|date',
            'organizer_id' => 'required|exists:organizers,id',
            'venue_id' => 'required|exists:venues,id',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }
        Event::create($data);
        
        // Clear dashboard cache when new event is created
        CacheService::clearDashboardCache();
        
        return redirect()->route('events.index')->with('status', 'Event created');
    }

    public function show(Event $event)
    {
        $event->load(['organizer','venue','attendees','vendors']);
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $organizers = CacheService::getOrganizerOptions();
        $venues = CacheService::getVenueOptions();
        return view('events.edit', compact('event','organizers','venues'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:120',
            'scheduled_at' => 'required|date',
            'organizer_id' => 'required|exists:organizers,id',
            'venue_id' => 'required|exists:venues,id',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }
        $event->update($data);
        
        // Clear dashboard cache when event is updated
        CacheService::clearDashboardCache();
        
        return redirect()->route('events.index')->with('status', 'Event updated');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        
        // Clear dashboard cache when event is deleted
        CacheService::clearDashboardCache();
        
        return back()->with('status', 'Event deleted');
    }
}
