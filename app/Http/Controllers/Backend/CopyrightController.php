<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Copyright;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CopyrightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-copyright');
        $copyright = Copyright::first();

        return view('backend.pages.general.copyright.copyright', compact('copyright'));
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
        Gate::authorize('edit-copyright');
        // dd($request->all());
        $copyright = Copyright::firstOrNew([]);

        $copyright->title = $request->title;
        $copyright->description = $request->description;


        $copyright->save();

        return redirect()->back()->with('message', 'Copyright Updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
