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

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->input('body'),
            'parent_id' => $request->input('parent_id'),
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            $comment->load('user.profile.profileImage');
            
            // Get user's avatar path to send back
            $avatar = '';
            if ($comment->user->profile && $comment->user->profile->profileImage) {
                $avatar = asset($comment->user->profile->profileImage->profile_image);
            } elseif ($comment->user->profile_photo_path) {
                $avatar = asset($comment->user->profile_photo_path);
            } else {
                $avatar = asset('assets/backend/images/faces/admin.png');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Comment added successfully!',
                'comment' => $comment,
                'user_name' => $comment->user->name,
                'user_avatar' => $avatar,
                'time' => $comment->created_at->format('F j, Y \a\t h:i A'),
                'replies_count' => $comment->repliesCount(),
                'is_owner' => auth()->check() && (auth()->user()->id === $comment->user_id),
                'can_delete' => auth()->check() && (auth()->user()->id === $comment->user_id || in_array(auth()->user()->role_id, [1, 2, 3])),
                'update_url' => route('posts.comments.update', [$post->id, $comment->id]),
                'destroy_url' => route('posts.comments.destroy', [$post->id, $comment->id]),
            ]);
        }

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate(['body' => 'required|string']);
        $comment->update(['body' => $request->input('body')]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Comment updated successfully!',
                'body' => $comment->body,
            ]);
        }

        return back()->with('message', 'Comment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $postId, $commentId)
    {
        $post = Post::findOrFail($postId);
        $comment = Comment::findOrFail($commentId);

        // Check if the user is authorized to delete the comment
        if (auth()->user()->id === $comment->user_id || in_array(auth()->user()->role_id, [1, 2, 3])) {
            $comment->delete();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Comment deleted successfully',
                ]);
            }

            return redirect()->back()->with('message', 'Comment deleted successfully');
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to delete this comment',
            ], 403);
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this comment');
    }

}
