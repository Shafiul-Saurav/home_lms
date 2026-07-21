<?php

namespace App\Http\Controllers\Backend;

use App\Models\News;
use App\Models\Newscategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Gate;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gate::authorize('index-news');

        $news = News::with('newsCategory')->latest('id')->paginate(1000);
        $newsCategories = Newscategory::get();

        return view('backend.pages.news.news', compact('news', 'newsCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Gate::authorize('create-news');

        $news = News::create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
        ]);

        $this->image_upload($request, $news->id);
        return redirect()->back()->with('message', 'News Created Successfully 🙂');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::findOrFail($id);
        return view('backend.pages.news.view', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Gate::authorize('edit-news');

        $news = News::findOrFail($id);
        $newsCategories = Newscategory::get();
        return view('backend.pages.news.edit', compact('news', 'newsCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Gate::authorize('edit-news');

        $news = News::findOrFail($id);

        $news->update([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
        ]);

        $this->image_upload($request, $news->id);
        return redirect()->back()->with('message', 'News Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Gate::authorize('delete-news');

        $news = News::findOrFail($id);

        $news->delete();
        return redirect()->back()->with('warning', 'News Moved to Trash Successfully');

    }

     /**
     * Store/Update the Image file.
     */
    public function image_upload($request, $news_id)
    {
        $news = News::findOrFail($news_id);

        if ($request->hasFile('news_image')) {
            if ($news->news_image && $news->news_image != 'default_news.jpg') {
                $photo_location = 'public/uploads/news/';
                $old_photo_location = $photo_location . $news->news_image;
                if (file_exists(base_path($old_photo_location))) {
                    @unlink(base_path($old_photo_location));
                }
            }

            $photo_location = 'public/uploads/news/';
            if (!is_dir(base_path($photo_location))) {
                mkdir(base_path($photo_location), 0755, true);
            }

            $uploaded_photo = $request->file('news_image');
            $new_photo_name = $news->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(600, 450)->save(base_path($new_photo_location), 40);

            $news->update([
                'news_image' => $new_photo_name,
            ]);
        }
    }

    public function checkActiveActive($news_id)
    {
        $news = News::find($news_id);
        if (!$news) {
            return response()->json([
                'type' => 'error',
                'message' => 'News not found'
            ], 404);
        }

        // Toggle the is_active status
        $news->is_active = $news->is_active ? 0 : 1;
        $news->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

    public function checkActiveHome($news_id)
    {
        $news = News::find($news_id);
        if (!$news) {
            return response()->json([
                'type' => 'error',
                'message' => 'News not found'
            ], 404);
        }

        // Toggle the is_active status
        $news->is_home = $news->is_home ? 0 : 1;
        $news->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }
}
