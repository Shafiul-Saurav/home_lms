<?php

namespace App\Http\Controllers\Backend;

use App\Models\PageName;
use App\Models\Breadcrumb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class BreadcrumbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-banner');
        $breadcrumbs = Breadcrumb::latest('id')->paginate(50);
        $pages = PageName::get();
        return view('backend.pages.general.breadcrumb.breadcrumb', compact('breadcrumbs', 'pages'));
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
        Gate::authorize('create-banner');
        // dd($request->all());

        $imageNameOne = null;
        // Check if a company logo is uploaded
        if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
            // Generate a unique name for the image
            $imageNameOne = time().'.'.$request->banner->extension();
            // Move the uploaded file to a public directory
            $request->banner->move(public_path('banner'), $imageNameOne);
        }

        Breadcrumb::create([
            'page_id' => $request->page_id,
            'title' => $request->title,
            'banner' => $imageNameOne
        ]);

        return redirect()->back()->with('message', 'Breadcrumb Created Successfully 🙂');
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
        Gate::authorize('edit-banner');
        $breadcrumb = Breadcrumb::where('id', $id)->first();
        $pages = PageName::get();

        return view('backend.pages.general.breadcrumb.edit', compact('breadcrumb', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-banner');
        // dd($request->all());
        $breadcrumb = Breadcrumb::findOrFail($id);

        if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
            // Delete the old image
            if ($breadcrumb->banner) {
                unlink('banner/' . $breadcrumb->banner);
            }
            // Upload new image
            $imageNameOne = time().'.'.$request->banner->extension();
            $request->banner->move(public_path('banner'), $imageNameOne);
            $breadcrumb->banner = $imageNameOne;
        }

        $breadcrumb->update([
            'page_id' => $request->page_id,
            'title' => $request->title,
        ]);
        return redirect()->route('breadcrumb.index')->with('message', 'Breadcrumb Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-banner');
        $breadcrumb = Breadcrumb::where('id', $id)->first();
        if($breadcrumb->banner != 'default_banner.jpg'){
            $photo_location_one = 'banner/'.$breadcrumb->banner;
            unlink($photo_location_one);
        }
        $breadcrumb->delete();

        return redirect()->back()->with('error', 'Breadcrumb Moved to Trash Successfully');
    }
}
