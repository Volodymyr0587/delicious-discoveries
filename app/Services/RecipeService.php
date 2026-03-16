<?php

namespace App\Services;

use App\Models\Recipe;
use App\Models\User;

class RecipeService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private ImageUploadService $imageUploadService
    ) {
    }

    public function create(array $data, User $user): Recipe
    {
        $data['ingredients'] = str($data['ingredients'])->squish();

        if (isset($data['image'])) {
            $data['image'] = $this->imageUploadService->upload($data['image']);
        }

        $data['user_id'] = $user->id;

        return Recipe::create($data);
    }

    public function update(Recipe $recipe, array $data): Recipe
    {
        $data['ingredients'] = str($data['ingredients'])->squish();

        if (isset($data['image'])) {
            $data['image'] = $this->imageUploadService->upload($data['image']);
        } else {
            unset($data['image']);
        }

        $recipe->update($data);

        return $recipe;
    }
}
