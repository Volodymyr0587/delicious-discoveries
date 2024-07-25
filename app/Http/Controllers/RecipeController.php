<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category_id = $request->input('category_id');

        $recipes = Recipe::ofCategory($category_id)->orderBy('recipe_name')->paginate(3);
        $categories = Category::all();

        return view('recipes.index', compact('recipes', 'categories', 'category_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('recipes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'recipe_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'ingredients' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data['ingredients'] = str($request->ingredients)->squish();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $recipe = new Recipe($data);
        $recipe->user()->associate($user);
        $recipe->category()->associate(Category::find($data['category_id']));
        $recipe->save();

        return to_route('recipes.index')->with('success', 'Recipe created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $recipe->incrementViews();

        $nextRecipe = Recipe::where('id', '>', $recipe->id)->orderBy('id')->first();
        $previousRecipe = Recipe::where('id', '<', $recipe->id)->orderBy('id', 'desc')->first();

        return view('recipes.show', compact('recipe', 'nextRecipe', 'previousRecipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'recipe_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'ingredients' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data['ingredients'] = str($request->ingredients)->squish();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        } else {
            unset($data['image']);
        }

        $recipe->update($data);
        $recipe->category()->associate(Category::find($data['category_id']));
        $recipe->save();

        return to_route('recipes.show', $recipe)->with('success', 'Recipe updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully.');
    }


    public function userRecipes(User $user, Request $request)
    {
        $category_id = $request->input('category_id');
        $categories = Category::all();
        $recipes = Recipe::ofUser($user->id)
                    ->ofCategory($category_id)
                    ->paginate(3);

        return view('recipes.index', compact('recipes', 'user', 'categories', 'category_id'));
    }


    public function likeRecipe(Recipe $recipe)
    {
        $user = auth()->user();

        if (!$user instanceof User) {
            return response()->json(['error' => 'You must be logged in to like a recipe.'], 403);
        }

        if ($user->id === $recipe->user_id) {
            return response()->json(['error' => 'You cannot like your own recipe.'], 403);
        }

        if ($recipe->isLikedBy($user)) {
            return response()->json(['error' => 'You have already liked this recipe.'], 403);
        }

        $like = new Like();
        $like->user()->associate($user);
        $like->recipe()->associate($recipe);
        $like->save();

        return response()->json(['success' => 'Recipe liked successfully.', 'likes_count' => $recipe->likes()->count()]);
    }

    public function unlikeRecipe(Recipe $recipe)
    {
        $user = auth()->user();

        $like = $recipe->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            return response()->json(['success' => 'Like removed successfully.', 'likes_count' => $recipe->likes()->count()]);
        }

        return response()->json(['error' => 'You have not liked this recipe.'], 403);
    }

}
