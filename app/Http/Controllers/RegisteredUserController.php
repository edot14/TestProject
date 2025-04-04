<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        // Validate
        $attributes = request()->validate([
            'first_name'        => ['required'],
            'last_name'         => ['required'],
            'email'             => ['required', 'email', 'max:254'],
            'password'          => ['required', Password::min(8), 'confirmed'], // Confirming password.
        ]);

        // Create the user
        $user = User::create($attributes);

        // Log in
        Auth::login($user);

        // Redirect
        return redirect('/jobs');


    }
}