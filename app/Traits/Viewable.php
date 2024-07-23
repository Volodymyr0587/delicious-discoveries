<?php

namespace App\Traits;

use App\Models\RecipeView;
use Illuminate\Support\Facades\Auth;


trait Viewable
{
    public function incrementViews()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $recipeId = $this->id;

            $view = RecipeView::firstOrCreate([
                'recipe_id' => $recipeId,
                'user_id' => $userId,
            ]);

            if ($view->wasRecentlyCreated) {
                $this->increment('views');
            }
        }
    }
}
