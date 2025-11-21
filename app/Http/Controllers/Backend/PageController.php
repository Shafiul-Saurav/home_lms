<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PageName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-page');
        $pages = PageName::latest('id')->paginate(50);
        return view('backend.pages.general.page.page', compact('pages'));
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
        Gate::authorize('create-page');
        // dd($request->all());

        PageName::create([
            'page' => $request->page
        ]);

        return redirect()->back()->with('message', 'Page Created Successfully');
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
        Gate::authorize('edit-page');
        $page = PageName::where('id', $id)->first();
        return view('backend.pages.general.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-page');
        $page = PageName::where('id', $id)->first();
        $page->update([
            'page' => $request->page
        ]);

        return redirect()->route('pages.index')->with('message', 'Page Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-page');
        $page = PageName::where('id', $id)->first();

        $page->delete();

        return redirect()->back()->with('error', 'Page Deleted Successfully');
    }
}
