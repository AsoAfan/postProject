<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view("session.create");
    }

    public function store()
    {
        $user = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($user))
            throw ValidationException::withMessages([
                'err' => "Invalid credentials"
            ]);

       return redirect('/home')->with('success', "Login succeed");
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/login')->with('success', "Logout succeed");
    }
}
