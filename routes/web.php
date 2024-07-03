<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;

Route::get('/', [RecipeController::class, 'index'])->name('recipes.index');

Route::middleware('guest')->group(function () {
    //% Auth
    Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store']);
    //% Log In
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});


Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth')->name('logout');

