<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WebsiteLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WebsiteLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $website_link = WebsiteLink::first();

        return view('backend.pages.general.website_link.website_link', compact('website_link'));
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
        $website_link = WebsiteLink::firstOrNew([]);

        $website_link->email = $request->email;
        $website_link->facebook = $request->facebook;
        $website_link->instagram = $request->instagram;
        $website_link->linkedIn = $request->linkedIn;
        $website_link->twitter = $request->twitter;
        $website_link->youtube = $request->youtube;
        $website_link->number = $request->number;
        $website_link->address = $request->address;
        $website_link->map_link = $request->map_link;


        $website_link->save();

        return redirect()->back()->with('message', 'Website Link Updated successfully');
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
