<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SearchRecipeController;

Route::get('/', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/{recipe}/show', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/user/{user}/recipes', [RecipeController::class, 'userRecipes'])->name('user.recipes');

//% Search
Route::get('/search', SearchRecipeController::class)->name('search');

Route::middleware('guest')->group(function () {
    //% Auth
    Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store']);
    //% Log In
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});


Route::middleware('auth')->group(function () {

    //% Recipes
    Route::name('recipes.')->group(function () {
        Route::get('/recipes/create', [RecipeController::class, 'create'])->name('create');
        Route::post('/recipes', [RecipeController::class, 'store'])->name('store');
        Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->can('edit', 'recipe')->name('edit');
        Route::patch('/recipes/{recipe}', [RecipeController::class, 'update'])->can('edit', 'recipe')->name('update');
        Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->can('edit', 'recipe')->name('destroy');
    });

    //% Comments
    Route::post('/recipes/{recipe}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->can('deleteComment', 'comment')->name('comment.destroy');

    //% Likes
    Route::post('/recipes/{recipe}/like', [RecipeController::class, 'likeRecipe'])->name('recipes.like');
    Route::delete('/recipes/{recipe}/unlike', [RecipeController::class, 'unlikeRecipe'])->name('recipes.unlike');

    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
});




