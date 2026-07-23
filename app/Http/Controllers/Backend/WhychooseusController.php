<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Whychooseus;
use Illuminate\Http\Request;

class WhychooseusController extends Controller
{
    public function index()
    {
        $items = Whychooseus::latest('id')->paginate(100);

        return view('backend.pages.whychooseuses.whychooseuses', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Whychooseus::create(array_merge($validated, [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]));

        return redirect()->back()->with('message', 'Why Choose Us Created Successfully 🙂');
    }

    public function edit(string $id)
    {
        $item = Whychooseus::findOrFail($id);

        return view('backend.pages.whychooseuses.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $item = Whychooseus::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update(array_merge($validated, [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]));

        return redirect()->route('whychooseuses.index')->with('message', 'Why Choose Us Updated Successfully 🙂');
    }

    public function destroy(string $id)
    {
        Whychooseus::findOrFail($id)->delete();

        return redirect()->back()->with('warning', 'Why Choose Us Deleted Successfully');
    }

    public function checkActive($id)
    {
        $item = Whychooseus::find($id);
        if (! $item) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }

        $item->is_active = $item->is_active ? 0 : 1;
        $item->save();

        return response()->json(['type' => 'success', 'message' => 'Status Updated']);
    }
}
