<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $visitors = Visitor::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhere('position', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(5)
        ->withQueryString();

        return view('visitors.index', compact('visitors'));
    }

    public function create()
    {
        return view('visitors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'created_at' => 'nullable|date',
        ]);

        Visitor::create($validated);

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor added successfully!');
    }

    public function show(Visitor $visitor)
    {
        return view('visitors.show', compact('visitor'));
    }

    public function edit(Visitor $visitor)
    {
        return view('visitors.edit', compact('visitor'));
    }

    public function update(Request $request, Visitor $visitor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'created_at' => 'nullable|date',
        ]);

        // Update visitor information
        $visitor->name = $validated['name'];
        $visitor->address = $validated['address'];
        $visitor->position = $validated['position'];

        // Update Date Added if a new date was provided
        if (!empty($validated['created_at'])) {
            $visitor->created_at = $validated['created_at'];
        }

        $visitor->save();

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor updated successfully!');
    }

    public function destroy(Visitor $visitor)
    {
        $visitor->delete();

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor deleted successfully!');
    }
}