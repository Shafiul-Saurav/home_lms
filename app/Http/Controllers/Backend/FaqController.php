<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-faq');
        
        $faqs = Faq::latest('id')->paginate(100);
        return view('backend.pages.faq.faq', compact('faqs'));
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
        Gate::authorize('create-faq');
        
        // dd($request->all());
        Faq::create([
            'faq_question' => $request->faq_question,
            'faq_answer' => $request->faq_answer,
        ]);

        return redirect()->back()->with('message', 'Faq Created Successfully 🙂');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faq = Faq::findOrFail($id);
        return view('backend.pages.faq.view', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('edit-faq');
        
        $faq = Faq::findOrFail($id);

        return view('backend.pages.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-faq');
        
        // dd($request->all());

        $faq = Faq::findOrFail($id);
        $faq->update([
            'faq_question' => $request->faq_question,
            'faq_answer' => $request->faq_answer,
        ]);

        return redirect()->back()->with('message', 'Faq Update Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-faq');
        
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->back()->with('error', 'Faq Delete Successfully');
    }
}
