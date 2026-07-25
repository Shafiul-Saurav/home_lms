<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Storyofgrowth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StoryofgrowthController extends Controller
{
    public function index()
    {
        Gate::authorize('index-about');

        $items = Storyofgrowth::latest('id')->paginate(100);

        return view('backend.pages.storyofgrowth.storyofgrowth', compact('items'));
    }

    public function store(Request $request)
    {
        Gate::authorize('edit-about');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Storyofgrowth::create($validated);

        return redirect()->back()->with('message', 'Story of Growth created successfully');
    }

    public function edit(string $id)
    {
        Gate::authorize('edit-about');

        $item = Storyofgrowth::findOrFail($id);

        return view('backend.pages.storyofgrowth.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-about');

        $item = Storyofgrowth::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $item->update($validated);

        return redirect()->route('storyofgrowths.index')->with('message', 'Story of Growth updated successfully');
    }

    public function destroy(string $id)
    {
        Gate::authorize('edit-about');

        Storyofgrowth::findOrFail($id)->delete();

        return redirect()->back()->with('warning', 'Story of Growth deleted successfully');
    }
}
