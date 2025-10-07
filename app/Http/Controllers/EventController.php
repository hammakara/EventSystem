<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $events = Event::latest()->paginate(10);

        return view('pages.admin.events.index', [
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.events.create', [
            'categories' => $categories
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }
        Event::create($data);
        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('category');
        return view('pages.admin.events.show', [
            'event' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('pages.admin.events.edit', [
            'event' => $event,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,cancelled,completed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }

            $data['image'] = $request->file('image')->store('events', 'public');
        }
        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        // Delete image if exists
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
