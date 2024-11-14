<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    // Store a new comment or reply
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->input('body'),
            'parent_id' => $request->input('parent_id'),
        ]);

        return back()->with('message', 'Comment added successfully!');
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
    public function edit(Post $post, Comment $comment)
    {
        // Ensure the user is authorized to edit the comment
        // $this->authorize('update', $comment);

        // return view('comments.edit', compact('comment', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate(['body' => 'required|string']);
        $comment->update(['body' => $request->input('body')]);

        return back()->with('message', 'Comment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($postId, $commentId)
    {
        $post = Post::findOrFail($postId);
        $comment = Comment::findOrFail($commentId);

        // Check if the user is authorized to delete the comment
        if (auth()->user()->id === $comment->user_id || in_array(auth()->user()->role_id, [1, 2, 3])) {
            // Delete the comment or reply
            $comment->delete();

            return redirect()->back()->with('message', 'Comment deleted successfully');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this comment');
    }

}
