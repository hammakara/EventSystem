<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::latest()->paginate(12);
        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'fee' => 'nullable|numeric',
            'details' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vendors', 'public');
        }
        Vendor::create($data);
        return redirect()->route('vendors.index')->with('status', 'Vendor created');
    }

    public function show(Vendor $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }

    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'fee' => 'nullable|numeric',
            'details' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vendors', 'public');
        }
        $vendor->update($data);
        return redirect()->route('vendors.index')->with('status', 'Vendor updated');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return back()->with('status', 'Vendor deleted');
    }
}
