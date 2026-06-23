<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Servicetwo;
use App\Models\Servicetwocategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServicetwoController extends Controller
{
    public function index()
    {
        // Gate::authorize('index-servicetwo');

        $servicetwos = Servicetwo::latest('id')->paginate(100);
        $categories = Servicetwocategory::latest('id')->get();

        return view('backend.pages.servicetwos.servicetwos', compact('servicetwos', 'categories'));
    }

    public function store(Request $request)
    {
        // Gate::authorize('create-servicetwo');

        $validated = $request->validate([
            'servicetwocategory_id' => 'required|exists:servicetwocategories,id',
            'title' => 'required|string|max:255',
            'service_icon' => 'required|string|max:255',
            'description' => 'required|string',
            'service_type' => 'required|string|max:255',
        ]);

        Servicetwo::create(array_merge($validated, [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]));

        return redirect()->back()->with('message', 'Service Two Created Successfully 🙂');
    }

    public function destroy(string $id)
    {
        // Gate::authorize('delete-servicetwo');

        $service = Servicetwo::findOrFail($id);
        $service->delete();

        return redirect()->back()->with('warning', 'Service Two Deleted Successfully');
    }

    public function edit(string $id)
    {
        // Gate::authorize('edit-servicetwo');

        $service = Servicetwo::findOrFail($id);
        $categories = Servicetwocategory::latest('id')->get();

        return view('backend.pages.servicetwos.edit', compact('service', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        // Gate::authorize('edit-servicetwo');

        $service = Servicetwo::findOrFail($id);

        $validated = $request->validate([
            'servicetwocategory_id' => 'required|exists:servicetwocategories,id',
            'title' => 'required|string|max:255',
            'service_icon' => 'required|string|max:255',
            'description' => 'required|string',
            'service_type' => 'required|string|max:255',
        ]);

        $service->update(array_merge($validated, [
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]));

        return redirect()->route('servicetwos.index')->with('message', 'Service Two Updated Successfully 🙂');
    }

    public function checkActive($service_id)
    {
        // Gate::authorize('edit-servicetwo');

        $service = Servicetwo::find($service_id);
        if (! $service) {
            return response()->json([
                'type' => 'error',
                'message' => 'Service not found',
            ], 404);
        }

        $service->is_active = $service->is_active ? 0 : 1;
        $service->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
