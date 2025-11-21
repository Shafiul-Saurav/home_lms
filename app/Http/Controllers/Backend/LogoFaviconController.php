<?php

namespace App\Http\Controllers\Backend;

use App\Models\LogoFavicon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class LogoFaviconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-logo-fav');
        $logo_fav = LogoFavicon::first();
        $logo_favs = LogoFavicon::all();

        return view('backend.pages.general.logo_fav.logo_fav', compact('logo_fav', 'logo_favs'));
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
        Gate::authorize('edit-logo-fav');

        // dd($request->all());
        $logo_fav = LogoFavicon::firstOrNew([]);

        $logo_fav->web_name = $request->web_name;

        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($logo_fav->logo && File::exists(public_path($logo_fav->logo))) {
                File::delete(public_path($logo_fav->logo));
            }

            $logoPath = 'uploads/logos/' . uniqid() . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads/logos'), $logoPath);
            $logo_fav->logo = $logoPath;
        }

        if ($request->hasFile('favicon')) {
            // Delete old favicon if it exists
            if ($logo_fav->favicon && File::exists(public_path($logo_fav->favicon))) {
                File::delete(public_path($logo_fav->favicon));
            }

            $faviconPath = 'uploads/favicons/' . uniqid() . '.' . $request->favicon->extension();
            $request->favicon->move(public_path('uploads/favicons'), $faviconPath);
            $logo_fav->favicon = $faviconPath;
        }

        $logo_fav->save();

        return redirect()->back()->with('message', 'Logo Updated successfully');
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
