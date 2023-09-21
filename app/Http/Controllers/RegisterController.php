<?php

namespace App\Http\Controllers;

use App\Models\User;

class registerController extends Controller
{
    function create()
    {
        return view("register.index");
    }

    public function store()
    {
        $newUser = request()->validate(
            [
                'name' => ['required', 'min:3', 'max:100'],
                'username' => ['required', 'min:3', 'max:255'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:4']
            ]
        );

        $user = User::create($newUser);

        auth()->login($user);


        return redirect('/home')->with('success', "Logged in with " . auth()->user()->username);


    }
}
