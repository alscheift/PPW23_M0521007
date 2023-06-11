<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    //
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * @throws ValidationException
     */
    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        // attempt to authenticate and log in the user
        // based on the provided credentials
        if (!auth()->attempt($attributes)
            &&
            !auth()->attempt([
                'username' => $attributes['email'],
                'password' => $attributes['password']
            ])
        ) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified. Please try again.'
            ]);
        }


        session()->regenerate(); // session fixation
        return redirect('/')->with('success', 'Welcome Back!');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye!');
    }
}
