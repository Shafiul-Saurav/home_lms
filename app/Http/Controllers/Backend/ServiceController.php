<?php

namespace App\Http\Controllers\Backend;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::latest('id')->paginate(100);
        return view('backend.pages.services.services', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Service::create([
            'title' => $request->title,
            'service_icon' => $request->service_icon,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('message', 'Service Created Successfully 🙂');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::findOrFail($id);

        return view('backend.pages.services.view', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);

        return view('backend.pages.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        $service->update([
            'title' => $request->title,
            'service_icon' => $request->service_icon,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('message', 'Service Update Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->back()->with('error', 'Service Delete Successfully');
    }


    public function checkActiveActive($service_id)
    {
        $service = Service::find($service_id);
        if (!$service) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // Toggle the is_active status
        $service->is_active = $service->is_active ? 0 : 1;
        $service->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }
}
