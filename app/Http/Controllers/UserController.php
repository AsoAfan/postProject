<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function storeCover()
    {
        request()->validate([
            'cover_image' => ['required', 'mimes:png,jpg,jpeg']
        ]);
        $image_name = request()->file('cover_image')->getClientOriginalName();
        $image_path = request()->file('cover_image')->storeAs('cover', $image_name, 'public');

        $user = User::find(auth()->id());
        $user->cover_image = $image_path;
        $user->save();

        return redirect('/profile/' . auth()->user()->username)->with('success', "Cover image updated successfully");
    }

    public function storeProImage()
    {
        request()->validate([
            'profile_image' => [ 'mimes:png,jpg,jpeg']
        ]);


        $image_name = auth()->user()->username . '.' . request()->file('profile_image')->guessClientExtension();
        $image_path = request()->file('profile_image')->storeAs('profile', $image_name, 'public');

        $user = User::find(auth()->id());
        $user->profile_image = $image_path;
        $user->save();

        return redirect('/profile/' . auth()->user()->username)->with('success', "profile image updated successfully");
    }
}
