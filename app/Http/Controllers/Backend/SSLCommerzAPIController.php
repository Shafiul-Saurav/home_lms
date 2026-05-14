<?php

namespace App\Http\Controllers\Backend;

use App\Models\SslCommerz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class SSLCommerzAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gate::authorize('index-sslcommerz'); // Temporarily commented out for development
        $sslcommerz = SslCommerz::first();
        return view('backend.pages.advance.sslcommerz.sslcommerz', compact('sslcommerz'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Gate::authorize('create-sslcommerz'); // Temporarily commented out for development
        
        $request->validate([
            'store_id' => 'required',
            'store_password' => 'required',
            'sslcommerz_url' => 'required|url',
            'sslcommerz_validation_url' => 'required|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $sslcommerz = SslCommerz::first();
        $logoName = $sslcommerz ? $sslcommerz->logo : null;

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($sslcommerz && $sslcommerz->logo && file_exists(public_path('uploads/sslcommerz/' . $sslcommerz->logo))) {
                unlink(public_path('uploads/sslcommerz/' . $sslcommerz->logo));
            }
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->move(public_path('uploads/sslcommerz'), $logoName);
        }

        SslCommerz::updateOrCreate(
            ['id' => 1],
            [
                'store_id' => $request->store_id,
                'store_password' => $request->store_password,
                'sslcommerz_url' => $request->sslcommerz_url,
                'sslcommerz_validation_url' => $request->sslcommerz_validation_url,
                'logo' => $logoName,
            ]
        );

        return redirect()->back()->with('message', 'SSLCommerz settings updated successfully.');
    }
}
