<?php

namespace App\Http\Controllers\Backend;

use App\Models\ShurjopaySetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShurjopayAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shurjopay = ShurjopaySetting::first();
        return view('backend.pages.advance.shurjopay.shurjopay', compact('shurjopay'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'store_id' => 'required',
            'prefix' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $shurjopay = ShurjopaySetting::first();
        $logoName = $shurjopay ? $shurjopay->logo : null;

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($shurjopay && $shurjopay->logo && file_exists(public_path('uploads/shurjopay/' . $shurjopay->logo))) {
                unlink(public_path('uploads/shurjopay/' . $shurjopay->logo));
            }
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->move(public_path('uploads/shurjopay'), $logoName);
        }

        ShurjopaySetting::updateOrCreate(
            ['id' => 1],
            [
                'username' => $request->username,
                'password' => $request->password,
                'store_id' => $request->store_id,
                'prefix' => $request->prefix,
                'logo' => $logoName,
            ]
        );

        return redirect()->back()->with('message', 'Shurjopay settings updated successfully.');
    }
}
