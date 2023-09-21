@props(['post'])

@php

    //    $user = \App\Models\User::find($post->comments);
    //    ddd($user);
    $comments = $post->comments()->with('user')->latest()->get();
@endphp

<div class="">
    <div class="h-fit hidden border-t border-gray-300 bg-white comment-input absolute z-20 p-4 mt-3 shadow-2xl rounded-xl">
        <form class="mb-8" method="post" action="/comment/{{$post->id}}">
            @csrf
            <label>
                Write your comment
                <textarea name="body"
                          placeholder="Write your comment..."
                          class=" p-3 border border-gray-300 rounded-xl mt-3 w-full resize-none shadow-lg"></textarea>

            </label>
            <x-button class="bg-blue-500 text-white mt-3 hover:bg-blue-600 ">Comment</x-button>
        </form>
        <div class="space-y-4 px-2 h-fit max-h-44 overflow-y-auto">

            @foreach($comments as $comment)
                <div class="bg-gray-200 p-4 rounded-lg flex gap-3">
                    <a href="/profile/{{$comment->user->username}}">
                        <img src="{{asset('storage/'.($comment->user->profile_image ?? "profile/default.jpg"))}}"
                             alt="profile_image"
                             class="mb-4 self-center w-14 h-14 bg-gray-400 rounded-xl object-cover "/>
                    </a>
                    <div>
                        <h3>{{$comment->user->username}}</h3>
                        <time class="text-xs text-gray-500 -mt-2 ">{{$comment->created_at->diffForHumans()}}</time>
                        <p class="font-sans text-sm">{{$comment->body}}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>