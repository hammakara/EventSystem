<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function index()
    {
        $organizers = Organizer::latest()->paginate(12);
        return view('organizers.index', compact('organizers'));
    }

    public function create()
    {
        return view('organizers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:organizers,email',
            'address' => 'nullable|string|max:500',
            'role' => 'nullable|string|max:120',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('organizers', 'public');
        }
        Organizer::create($data);
        return redirect()->route('organizers.index')->with('status', 'Organizer created');
    }

    public function show(Organizer $organizer)
    {
        return view('organizers.show', compact('organizer'));
    }

    public function edit(Organizer $organizer)
    {
        return view('organizers.edit', compact('organizer'));
    }

    public function update(Request $request, Organizer $organizer)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:organizers,email,' . $organizer->id,
            'address' => 'nullable|string|max:500',
            'role' => 'nullable|string|max:120',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('organizers', 'public');
        }
        $organizer->update($data);
        return redirect()->route('organizers.index')->with('status', 'Organizer updated');
    }

    public function destroy(Organizer $organizer)
    {
        $organizer->delete();
        return back()->with('status', 'Organizer deleted');
    }
}
