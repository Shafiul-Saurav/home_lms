<?php

namespace App\Http\Controllers\Backend;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-privacy');

        $privacyPolicy = PrivacyPolicy::first();
        return view('backend.pages.privacy_policy.privacy_policy', compact('privacyPolicy'));
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
        Gate::authorize('edit-privacy');

        $privacyPolicy = PrivacyPolicy::firstOrNew();
        $privacyPolicy->title = $request->title;
        $privacyPolicy->last_updated = now();
        $privacyPolicy->content = $request->content;
        $privacyPolicy->status = $request->status ?? 'active';

        $privacyPolicy->save();

        return redirect()->back()->with('message', 'Privacy Policy updated successfully');
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