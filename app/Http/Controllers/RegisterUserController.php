<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        //% validate
        $attributes = request()->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password'=> ['required', Password::min(6), 'confirmed'],
        ]);

        //% create the user
        $user = User::create($attributes);
        //% log in
        Auth::login($user);
        //% Redirect
        return redirect()->route('recipes.index');
    }
}
