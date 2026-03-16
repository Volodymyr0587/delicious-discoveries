<?php

namespace App\Services;

use App\Models\Like;
use App\Models\Recipe;
use App\Models\User;

class LikeService
{
    public function like(Recipe $recipe, User $user): array
    {
        if ($user->id === $recipe->user_id) {
            return ['error' => 'You cannot like your own recipe.'];
        }

        if ($recipe->isLikedBy($user)) {
            return ['error' => 'You have already liked this recipe.'];
        }

        $like = new Like();
        $like->user()->associate($user);
        $like->recipe()->associate($recipe);
        $like->save();

        return [
            'success' => 'Recipe liked successfully.',
            'likes_count' => $recipe->likes()->count()
        ];
    }

    public function unlike(Recipe $recipe, User $user): array
    {
        $like = $recipe->likes()->where('user_id', $user->id)->first();

        if (!$like) {
            return ['error' => 'You have not liked this recipe.'];
        }

        $like->delete();

        return [
            'success' => 'Like removed successfully.',
            'likes_count' => $recipe->likes()->count()
        ];
    }
}
