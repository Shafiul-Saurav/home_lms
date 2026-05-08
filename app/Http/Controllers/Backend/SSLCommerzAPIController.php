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
        ]);

        SslCommerz::updateOrCreate(
            ['id' => 1],
            [
                'store_id' => $request->store_id,
                'store_password' => $request->store_password,
                'sslcommerz_url' => $request->sslcommerz_url,
                'sslcommerz_validation_url' => $request->sslcommerz_validation_url,
            ]
        );

        return redirect()->back()->with('success', 'SSLCommerz settings updated successfully.');
    }
}
