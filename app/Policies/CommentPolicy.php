<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class CommentPolicy
{
    /**
     * Determine if the given user can create a comment.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        // Allow only authenticated users to create comments
        return $user !== null;
    }

    /**
     * Determine if the given user can update the comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return bool
     */
    public function update(User $user, Comment $comment)
    {
        // Allow users to edit their own comments
        return $user->id === $comment->user_id;
    }

    /**
     * Determine if the given user can delete the comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return bool
     */
    public function delete(User $user, Comment $comment)
    {
        // Allow users to delete their own comments or admins to delete any comment
        return $user->id === $comment->user_id || $user->is_admin;
    }
}
