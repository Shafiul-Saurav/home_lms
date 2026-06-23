<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Whatyouget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WhatyougetController extends Controller
{
    public function index()
    {
        // Gate::authorize('index-whatyouget');

        $items = Whatyouget::latest('id')->paginate(100);
        return view('backend.pages.whatyougets.whatyougets', compact('items'));
    }

    public function store(Request $request)
    {
        // Gate::authorize('create-whatyouget');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Whatyouget::create(array_merge($validated, [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]));

        return redirect()->back()->with('message', 'What You Get Created Successfully 🙂');
    }

    public function edit(string $id)
    {
        // Gate::authorize('edit-whatyouget');

        $item = Whatyouget::findOrFail($id);
        return view('backend.pages.whatyougets.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        // Gate::authorize('edit-whatyouget');

        $item = Whatyouget::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update(array_merge($validated, [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]));

        return redirect()->route('whatyougets.index')->with('message', 'What You Get Updated Successfully 🙂');
    }

    public function destroy(string $id)
    {
        // Gate::authorize('delete-whatyouget');

        $item = Whatyouget::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('warning', 'What You Get Deleted Successfully');
    }

    public function checkActive($id)
    {
        $item = Whatyouget::find($id);
        if (! $item) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $item->is_active = $item->is_active ? 0 : 1;
        $item->save();
        return response()->json(['type' => 'success', 'message' => 'Status Updated']);
    }
}
