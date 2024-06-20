<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LogoFavicon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GeneralSettingController extends Controller
{
    public function logoFav()
    {
        $logo_fav = LogoFavicon::first(); // Assuming there is only one logo and favicon
        $logo_favs = LogoFavicon::all();

        return view('backend.pages.general.logo_fav.logo_fav', compact('logo_fav', 'logo_favs'));
    }

    public function logoFavUpdate(Request $request)
    {
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

        return redirect()->route('logo.fav')->with('message', 'Logo Updated successfully');
    }


}
