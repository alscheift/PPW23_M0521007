<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        // create the user
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3|unique:users,username', // unique:users,username means that the username must be unique in the users table
//            'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')], // another way, btw u can use ->ignore
            'email' => ['required', 'email', 'max:255', 'unique:users,email'], // unique:users,email means that the email must be unique in the users table
            // to prevent SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'already@already.already' for key 'users.users_email_unique'
            'password' => ['required', 'max:255', 'min:7'] // better way to write it
        ]);

        $user = User::create($attributes);

//        session()->flash('success', 'Your account has been created.');
// or

        // log the user in
        auth()->login($user);
        return redirect('/')->with('success', 'Your account has been created.'); // flash data will be available for the next request
    }
}
