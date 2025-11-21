<?php

namespace App\Http\Controllers\Backend;

use App\Models\TermsAndConditions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class TermsAndConditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-terms');

        $termsAndConditions = TermsAndConditions::first();
        return view('backend.pages.terms_and_conditions.terms_and_conditions', compact('termsAndConditions'));
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
        Gate::authorize('edit-terms');

        $termsAndConditions = TermsAndConditions::firstOrNew();
        $termsAndConditions->title = $request->title;
        $termsAndConditions->last_updated = now();
        $termsAndConditions->content = $request->content;
        $termsAndConditions->status = $request->status ?? 'active';

        $termsAndConditions->save();

        return redirect()->back()->with('message', 'Terms & Conditions updated successfully');
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