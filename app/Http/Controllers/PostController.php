<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function store()
    {

        $newPost = request()->validate([
            'post_image' => 'mimes:png,jpg,jpeg'
        ]);

        if (!(request('body') || request('post_image')))
            return redirect('/profile/bbb');

//        dd(request()->file('post_image')->getClientOriginalName());

        if (request('post_image')) {
            $image_name = request()->file('post_image')->getClientOriginalName();
            $image_path = request()->file('post_image')->storeAs('storage', auth()->id() . '.' . $image_name, 'public');
        }

//        dd($image_name, $image_path);
        $post = Post::create([
            'user_id' => auth()->id(),
            'body' => request()->get('body'),
            'image' => $image_path ?? null,

        ]);

        return redirect('/home')->with('success', "Success");

    }

    public function share($post)
    {
        $sharedPost = Post::find($post);
//        dd($sharedPost->user->username);
        Post::create([
            'user_id' => auth()->id(),
            'body' => $sharedPost->body,
            'image' => $sharedPost->image,
            'is_shared' => true,
            'author'=> $sharedPost->user->username,
            'share_post_id' => $sharedPost->id
        ]);
        return back();
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post->image)
            File::delete(public_path('storage/' . $post->image));
        $post->delete();

        return redirect("/home")->with('success', "Post successfully deleted");


    }


}
