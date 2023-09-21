<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    public function like($id)
    {

        $like = Like::where('post_id', $id)->where('user_id', auth()->id())->first();
        $post = Post::where('id', $id)->first();

        if ($like) {
            $like->delete();
            if (isset($post->share_post_id))
                Like::where('post_id', $post->share_post_id)->where('user_id', auth()->id())->first()->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'post_id' => $id
            ]);

            if (isset($post->share_post_id))
                Like::create([
                    'user_id' => auth()->id(),
                    'post_id' => $post->share_post_id
                ]);
        }


        return back();

    }
}
