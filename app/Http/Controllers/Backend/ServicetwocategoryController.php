<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Servicetwocategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServicetwocategoryController extends Controller
{
    public function index()
    {
        // Gate::authorize('index-servicetwocategory');

        $categories = Servicetwocategory::latest('id')->paginate(30);
        return view('backend.pages.servicetwocategories.category', compact('categories'));
    }

    public function store(Request $request)
    {
        // Gate::authorize('create-servicetwocategory');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Servicetwocategory::create(array_merge($validated, [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]));

        return redirect()->back()->with('message', 'Service Two Category Created Successfully 🙂');
    }

    public function edit(string $id)
    {
        // Gate::authorize('edit-servicetwocategory');

        $category = Servicetwocategory::findOrFail($id);
        return view('backend.pages.servicetwocategories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        // Gate::authorize('edit-servicetwocategory');

        $category = Servicetwocategory::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $category->update(array_merge($validated, [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]));

        return redirect()->route('servicetwocategories.index')->with('message', 'Service Two Category Updated Successfully 🙂');
    }

    public function destroy(string $id)
    {
        // Gate::authorize('delete-servicetwocategory');

        $category = Servicetwocategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('warning', 'Service Two Category Deleted Successfully');
    }

    public function checkActive($category_id)
    {
        // Gate::authorize('edit-servicetwocategory');

        $category = Servicetwocategory::find($category_id);
        if (! $category) {
            return response()->json(['type' => 'error', 'message' => 'Category not found'], 404);
        }

        $category->is_active = $category->is_active ? 0 : 1;
        $category->save();

        return response()->json(['type' => 'success', 'message' => 'Status Updated']);
    }
}
