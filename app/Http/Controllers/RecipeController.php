<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\LikeService;
use App\Services\RecipeService;
use App\Services\ReadingTimeService;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

class RecipeController extends Controller
{
    public function __construct(
        private RecipeService $recipeService,
        private LikeService $likeService,
        private ReadingTimeService $readingTimeService
    ) {
    }

    public function index(Request $request)
    {
        $categoryId = $request->integer('category_id');

        $recipes = Recipe::ofCategory($categoryId)
            ->with(['category', 'user'])
            ->orderBy('name')
            ->paginate(3);

        $categories = Category::withCount('recipes')->get();

        return view('recipes.index', compact('recipes', 'categories', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('recipes.create', compact('categories'));
    }

    public function store(StoreRecipeRequest $request)
    {
        $recipe = $this->recipeService->create(
            $request->validated(),
            $request->user()
        );

        return to_route('recipes.index')
            ->with('success', 'Recipe created successfully.');
    }

    public function show(Recipe $recipe)
    {
        $recipe->load(['category', 'user', 'likes']);

        $recipe->incrementViews();

        $readingTime = $this->readingTimeService
            ->calculateReadingTime($recipe->description);

        return view('recipes.show', [
            'recipe' => $recipe,
            'nextRecipe' => $recipe->next(),
            'previousRecipe' => $recipe->previous(),
            'readingTime' => $readingTime,
        ]);
    }

    public function edit(Recipe $recipe)
    {
        $categories = Category::all();

        return view('recipes.edit', compact('recipe', 'categories'));
    }

    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $this->recipeService->update(
            $recipe,
            $request->validated()
        );

        return to_route('recipes.show', $recipe)
            ->with('success', 'Recipe updated successfully.');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return to_route('recipes.index')
            ->with('success', 'Recipe deleted successfully.');
    }

    public function userRecipes(User $user, Request $request)
    {
        $categoryId = $request->integer('category_id');

        $recipes = Recipe::ofUser($user->id)
            ->ofCategory($categoryId)
            ->with(['category', 'user'])
            ->paginate(3);

        $categories = Category::withCount('recipes')->get();

        return view('recipes.index', compact('recipes', 'user', 'categories', 'categoryId'));
    }

    public function likeRecipe(Recipe $recipe, Request $request)
    {
        $result = $this->likeService->like(
            $recipe,
            $request->user()
        );

        return response()->json($result);
    }

    public function unlikeRecipe(Recipe $recipe, Request $request)
    {
        $result = $this->likeService->unlike(
            $recipe,
            $request->user()
        );

        return response()->json($result);
    }
}