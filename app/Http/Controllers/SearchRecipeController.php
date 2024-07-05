<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchRecipeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Validate the search input
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $search = $request->input('search');

        $category_id = $request->input('category_id');
        $categories = Category::all();

        $recipes = Recipe::whereAny(
            [
                'recipe_name',
                'ingredients',
            ],
            'LIKE',
            "%$search%"
        )->paginate(3);

        return view('recipes.search', compact('recipes', 'search', 'category_id', 'categories'));
    }
}
