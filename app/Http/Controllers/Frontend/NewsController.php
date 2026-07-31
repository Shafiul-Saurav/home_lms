<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use App\Models\Newscategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class NewsController extends Controller
{
    /**
     * Display a listing of news for frontend.
     */
    public function index()
    {
        $news = News::with('newsCategory', 'user')
            ->where('is_active', 1)
            ->latest('id')
            ->paginate(12);

        $newsCategories = Newscategory::where('is_active', 1)->get();
        $popularNews = News::where('is_active', 1)
            ->latest('created_at')
            ->limit(5)
            ->get();

        return view('frontendone.pages.news.news', compact('news', 'newsCategories', 'popularNews'));
    }

    /**
     * Show news details page.
     */
    public function show(string $id)
    {
        $news = News::with('user.profile.profileImage', 'newsCategory')
            ->where('is_active', 1)
            ->findOrFail($id);

        $newsCategories = Newscategory::where('is_active', 1)->get();
        $popularNews = News::where('is_active', 1)
            ->latest('created_at')
            ->limit(5)
            ->get();

        return view('frontendone.pages.news.news_details', compact('news', 'newsCategories', 'popularNews'));
    }

    /**
     * Show the form for creating a new news.
     */
    public function create()
    {
        $newsCategories = Newscategory::where('is_active', 1)->get();
        return view('frontendone.pages.news.create', compact('newsCategories'));
    }

    /**
     * Store a newly created news.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:newscategories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_des' => 'required|string',
            'long_des' => 'required|string',
            'news_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $news = News::create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'is_active' => 0, // Require admin approval
        ]);

        $this->image_upload($request, $news->id);

        return redirect()->back()->with('message', 'News submitted successfully. Awaiting admin approval!');
    }

    /**
     * Store/Update the Image file.
     */
    public function image_upload($request, $news_id)
    {
        $news = News::findOrFail($news_id);

        if ($request->hasFile('news_image')) {
            $photo_location = public_path('uploads/news/');

            if ($news->news_image && $news->news_image !== 'default_news.jpg') {
                $old_photo_path = $photo_location . $news->news_image;
                if (file_exists($old_photo_path)) {
                    unlink($old_photo_path);
                }
            }

            if (!file_exists($photo_location)) {
                mkdir($photo_location, 0755, true);
            }

            $uploaded_photo = $request->file('news_image');
            $extension = strtolower($uploaded_photo->getClientOriginalExtension());
            $new_photo_name = $news->id . '.' . $extension;
            $new_photo_path = $photo_location . $new_photo_name;

            $img = Image::read($uploaded_photo)->resize(600, 450);

            if ($extension === 'webp') {
                $img->toWebp(40)->save($new_photo_path);
            } else {
                $img->toJpeg(40)->save($new_photo_path);
            }

            $news->update([
                'news_image' => $new_photo_name,
            ]);
        }
    }

    /**
     * Search/Filter news.
     */
    public function search(Request $request)
    {
        $query = News::where('is_active', 1);

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $news = $query->latest('id')->paginate(12);
        $newsCategories = Newscategory::where('is_active', 1)->get();
        $popularNews = News::where('is_active', 1)
            ->latest('created_at')
            ->limit(5)
            ->get();

        return view('frontendone.pages.news.news', compact('news', 'newsCategories', 'popularNews'));
    }

    /**
     * Display combined News & Blog page with two separate sections.
     */
    public function newsBlog()
    {
        $news = News::with('newsCategory', 'user')
            ->where('is_active', 1)
            ->latest('id')
            ->limit(6)
            ->get();

        $posts = \App\Models\Post::with('postCategory', 'user')
            ->where('is_active', 1)
            ->latest('id')
            ->limit(6)
            ->get();

        return view('frontendone.pages.news.news_blog', compact('news', 'posts'));
    }
}
