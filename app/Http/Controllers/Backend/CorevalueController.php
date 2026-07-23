<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Corevalue;
use Illuminate\Http\Request;

class CorevalueController extends Controller
{
    public function index()
    {
        $items = Corevalue::latest('id')->paginate(100);

        return view('backend.pages.corevalues.corevalues', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Corevalue::create(array_merge($validated, [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]));

        return redirect()->back()->with('message', 'Core Value Created Successfully 🙂');
    }

    public function edit(string $id)
    {
        $item = Corevalue::findOrFail($id);

        return view('backend.pages.corevalues.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $item = Corevalue::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'service_icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item->update(array_merge($validated, [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]));

        return redirect()->route('corevalues.index')->with('message', 'Core Value Updated Successfully 🙂');
    }

    public function destroy(string $id)
    {
        Corevalue::findOrFail($id)->delete();

        return redirect()->back()->with('warning', 'Core Value Deleted Successfully');
    }

    public function checkActive($id)
    {
        $item = Corevalue::find($id);
        if (! $item) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }

        $item->is_active = $item->is_active ? 0 : 1;
        $item->save();

        return response()->json(['type' => 'success', 'message' => 'Status Updated']);
    }
}
