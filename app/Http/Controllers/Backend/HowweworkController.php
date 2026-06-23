<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Howwework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HowweworkController extends Controller
{
    public function index()
    {
        // Gate::authorize('index-howwework');

        $items = Howwework::latest('id')->paginate(100);
        return view('backend.pages.howweworks.howweworks', compact('items'));
    }

    public function store(Request $request)
    {
        // Gate::authorize('create-howwework');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Howwework::create(array_merge($validated, [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]));

        return redirect()->back()->with('message', 'How We Work Created Successfully 🙂');
    }

    public function edit(string $id)
    {
        // Gate::authorize('edit-howwework');

        $item = Howwework::findOrFail($id);
        return view('backend.pages.howweworks.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        // Gate::authorize('edit-howwework');

        $item = Howwework::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update(array_merge($validated, [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]));

        return redirect()->route('howweworks.index')->with('message', 'How We Work Updated Successfully 🙂');
    }

    public function destroy(string $id)
    {
        // Gate::authorize('delete-howwework');

        $item = Howwework::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('warning', 'How We Work Deleted Successfully');
    }

    public function checkActive($id)
    {
        $item = Howwework::find($id);
        if (! $item) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $item->is_active = $item->is_active ? 0 : 1;
        $item->save();
        return response()->json(['type' => 'success', 'message' => 'Status Updated']);
    }
}
