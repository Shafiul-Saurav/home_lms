<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::with('user')->latest('id')->paginate(10000);
        return view('backend.pages.testimonial.testimonial', compact('testimonials'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.pages.testimonial.view', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $testimonial->delete();
        return redirect()->back()->with('warning', 'Review Deleted Successfully');
    }

    public function checkActiveActive($testimonial_id)
    {
        $testimonial = Testimonial::find($testimonial_id);
        if (!$testimonial) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // Toggle the is_active status
        $testimonial->is_active = $testimonial->is_active ? 0 : 1;
        $testimonial->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

    public function checkActiveHome($testimonial_id)
    {
        $testimonial = Testimonial::find($testimonial_id);
        if (!$testimonial) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // Toggle the is_active status
        $testimonial->is_home = $testimonial->is_home ? 0 : 1;
        $testimonial->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }
}
