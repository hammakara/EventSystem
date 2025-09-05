<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function index()
    {
        $attendees = Attendee::latest()->paginate(20);
        return view('attendees.index', compact('attendees'));
    }

    public function create()
    {
        return view('attendees.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'status' => 'required|string|max:50',
            'preferences' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);
        if (is_string($data['preferences'] ?? null)) {
            $data['preferences'] = [ 'raw' => $data['preferences'] ];
        }
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('attendees', 'public');
        }
        Attendee::create($data);
        return redirect()->route('attendees.index')->with('status', 'Attendee created');
    }

    public function show(Attendee $attendee)
    {
        return view('attendees.show', compact('attendee'));
    }

    public function edit(Attendee $attendee)
    {
        return view('attendees.edit', compact('attendee'));
    }

    public function update(Request $request, Attendee $attendee)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'status' => 'required|string|max:50',
            'preferences' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);
        if (is_string($data['preferences'] ?? null)) {
            $data['preferences'] = [ 'raw' => $data['preferences'] ];
        }
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('attendees', 'public');
        }
        $attendee->update($data);
        return redirect()->route('attendees.index')->with('status', 'Attendee updated');
    }

    public function destroy(Attendee $attendee)
    {
        $attendee->delete();
        return back()->with('status', 'Attendee deleted');
    }
}
