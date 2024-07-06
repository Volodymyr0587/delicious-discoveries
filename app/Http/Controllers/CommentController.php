<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate([
            'body' => 'required|min:2|max:1000'
        ]);

        if (auth()->id() == $recipe->user->id) {
            return back()->withErrors('Ви не можете коментувати власний рецепт.');
        }

        $recipe->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);

        return back()->with('success', 'Коментар успішно додано');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Коментар успішно видалено');
    }
}
