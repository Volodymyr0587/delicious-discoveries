<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RecipePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function edit(User $user, Recipe $recipe): bool
    {
        return $recipe->user->is($user);
    }


}
