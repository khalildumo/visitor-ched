
<?php

namespaceApp\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    // Display all visitors
    public function index()
    {
        $visitors = Visitor::latest()->get();

        return view('visitors.index', compact('visitors'));
    }

    // Show create form
    public function create()
    {
        return view('visitors.create');
    }

    // Save new visitor
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        Visitor::create($request->only([
            'name',
            'address',
            'position',
        ]));

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor added successfully!');
    }

    // Display one visitor
    public function show(Visitor $visitor)
    {
        return view('visitors.show', compact('visitor'));
    }

    // Show edit form
    public function edit(Visitor $visitor)
    {
        return view('visitors.edit', compact('visitor'));
    }

    // Update visitor
    public function update(Request $request, Visitor $visitor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        $visitor->update($request->only([
            'name',
            'address',
            'position',
        ]));

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor updated successfully!');
    }

    // Delete visitor
    public function destroy(Visitor $visitor)
    {
        $visitor->delete();

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor deleted successfully!');
    }
}
