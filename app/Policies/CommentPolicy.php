<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    public function deleteComment(User $user, Comment $comment): bool
    {
        return $comment->user->is($user);
    }
}
