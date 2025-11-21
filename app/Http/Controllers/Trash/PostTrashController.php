<?php

namespace App\Http\Controllers\Trash;

use App\Models\Post;
use App\Models\Postcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PostTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-post');
        
        $posts = Post::onlyTrashed()->with('postCategory')->latest('id')->paginate(1000);
        $postCategories = Postcategory::get();

        return view('backend.pages.post.trash', compact('posts', 'postCategories'));
    }

    public function restore($id)
    {
        Gate::authorize('delete-post');
        
        $posts = Post::onlyTrashed()->findOrFail($id);
        $posts->restore();

        return redirect()->back()->with('info', 'Post Restored Successfully 🙂');
    }

    public function forceDelete(string $id)
    {
        Gate::authorize('delete-post');
        
        $posts = Post::onlyTrashed()->findOrFail($id);

        // Delete main room image if it's not the default
        if($posts->post_image != 'default_post.jpg'){
            $photo_location = 'uploads/posts/'.$posts->post_image;
            unlink($photo_location);
        }
        $posts->forceDelete();

        return redirect()->back()->with('error', 'Post Deleted Permanently');

    }
}
