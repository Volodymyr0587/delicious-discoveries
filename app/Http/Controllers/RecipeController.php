<?php

namespace App\Http\Controllers;

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

        $recipes = Recipe::ofCategory($category_id)->get();
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
            'image' => 'nullable'
        ]);

        $request->ingredients = str($request->ingredients)->squish();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $recipe = new Recipe($data);
        $recipe->user()->associate($user);
        $recipe->category()->associate(Category::find($data['category_id']));
        $recipe->save();

        return to_route('recipes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        //
    }
}
