<?php

namespace App\Http\Controllers\Trash;

use App\Models\News;
use App\Models\Newscategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class NewsTrashController extends Controller
{
    public function trash()
    {
        // Gate::authorize('delete-news');

        $news = News::onlyTrashed()->with('newsCategory')->latest('id')->paginate(1000);
        $newsCategories = Newscategory::get();

        return view('backend.pages.news.trash', compact('news', 'newsCategories'));
    }

    public function restore($id)
    {
        // Gate::authorize('delete-news');

        $news = News::onlyTrashed()->findOrFail($id);
        $news->restore();

        return redirect()->back()->with('info', 'News Restored Successfully 🙂');
    }

    public function forceDelete(string $id)
    {
        // Gate::authorize('delete-news');

        $news = News::onlyTrashed()->findOrFail($id);

        // Delete main news image if it's not the default
        if($news->news_image != 'default_news.jpg'){
            $photo_location = 'public/uploads/news/'.$news->news_image;
            if (file_exists(base_path($photo_location))) {
                unlink(base_path($photo_location));
            }
        }
        $news->forceDelete();

        return redirect()->back()->with('error', 'News Deleted Permanently');

    }
}
