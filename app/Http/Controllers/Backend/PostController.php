<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Models\Postcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-post');

        $posts = Post::with('postCategory')->latest('id')->paginate(1000);
        $postCategories = Postcategory::get();

        return view('backend.pages.post.post', compact('posts', 'postCategories'));
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
        Gate::authorize('create-post');

        // dd($request->all());

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
        ]);

        $this->image_upload($request, $post->id);
        return redirect()->back()->with('message', 'Post Created Successfully 🙂');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('backend.pages.post.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('edit-post');

        $post = Post::findOrFail($id);
        $postCategories = Postcategory::get();
        return view('backend.pages.post.edit', compact('post', 'postCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-post');

        $post = Post::findOrFail($id);

        $post->update([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
        ]);

        $this->image_upload($request, $post->id);
        return redirect()->back()->with('message', 'Post Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-post');

        $post = Post::findOrFail($id);

        $post->delete();
        return redirect()->back()->with('warning', 'Post Moved to Trash Successfully');

    }

     /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $post_id)
    {
        $post = Post::findOrFail($post_id);
        // dd($request->all(), $post, $request->hasFile('post_image'));
        if ($request->hasFile('post_image')) {
            if ($post->post_image != 'default_post.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/posts/';
                $old_photo_location = $photo_location . $post->post_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/posts/';
            $uploaded_photo = $request->file('post_image');
            $new_photo_name = $post->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(600,450)->save(base_path($new_photo_location), 40);
            //$user = User::find($post->id);
            $check = $post->update([
                'post_image' => $new_photo_name,
            ]);
        }
    }

    public function checkActiveActive($post_id)
    {
        $post = Post::find($post_id);
        if (!$post) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // Toggle the is_active status
        $post->is_active = $post->is_active ? 0 : 1;
        $post->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

    public function checkActiveHome($post_id)
    {
        $post = Post::find($post_id);
        if (!$post) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // Toggle the is_active status
        $post->is_home = $post->is_home ? 0 : 1;
        $post->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }
}
