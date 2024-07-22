<?php

namespace App\Traits;
use Illuminate\Support\Facades\Session;

trait Viewable
{
    public function incrementViews()
    {
        $recipeKey = 'recipe_' . $this->id;

        if (!Session::has($recipeKey)) {
            $this->increment('views');
            Session::put($recipeKey, 1);
        }
    }
}
