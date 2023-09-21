@php
    //dd($post->likes()->where('user_id',auth()->id())->exists());


        $likedByUser = $post->likes()->where('user_id',auth()->id())->exists();

//        dd(\App\Models\User::find($post->likes));

//dd($post->likes);

        $likedUseres = \App\Models\User::find($post->likes);

@endphp

<div class="max-w-sm sm:max-w-xl mx-auto mb-24">
    <section class="relative gap-4 w-full">
        <div class="px-3 flex-shrink-0 h-fit flex gap-8">

            <a href="/profile/{{$post->user->username}}">
                <img src="{{asset('storage/'.($post->user->profile_image ?? 'profile/default.jpg'))}}"
                     alt="profile_image"
                     class="mb-4 self-center w-14 h-14 bg-gray-400 rounded-xl object-cover ">

            </a>


            <div class="mr-auto">
                <h2 class="text-lg font-bold">{{$post->user->username}}</h2>

                <div class="mt-1 text-gray-400 text-xs">
                    {{--                    TODO: brwatawa bo profile asliaka --}}
                    @if($post->is_shared)
                        <p class="font-normal ">Shared from <a class="underline"
                                                               href="profile/{{$post->author}}">{{$post->author}}</a>
                        </p>
                    @endif
                    <time>{{$post->created_at->diffForHUmans()}}</time>
                </div>
            </div>
            @if($post->user_id === auth()->id())

                <div class="relative">
                    <div class="more-btn justify-center flex -mt-1 gap-0.5 cursor-pointer">
                        <span class="text-xl h-fit">.</span>
                        <span class="text-xl">.</span>
                        <span class="text-xl">.</span>
                    </div>

                    <ul class="more absolute top-6 -left-6 hidden bg-gray-200 p-3 rounded-xl">
                        <li><a href="/delete/{{$post->id}}" class="text-red-500">Delete</a></li>
                    </ul>
                </div>
            @endif


        </div>


        <div class="w-full">

            <div>
                <div class="mb-3">
                    <p class="font-sans w-full overflow-x-hidden p-3 pt-0 rounded-lg mt-0 leading-relaxed">
                        {{$post->body}}
                    </p>
                    <div class="flex justify-center overflow-hidden bg-gray-200 w-full rounded-lg">


                        @if($post->image )
                            <img src={{asset('storage/'. $post->image)}}/>
                        @endif

                    </div>
                </div>

                <div class="flex justify-between items-center border-y border-gray-400">
                    <div class="group relative">
                        <a href="/like/{{$post->id}}"
                           class="flex justify-center items-center gap-3 cursor-pointer py-1 px-2 rounded-l hover:bg-gray-300 text-center w-fit whitespace-nowrap">
                            {{$post->likes->count() > 0 ? $post->likes->count() : ""}}

                            @if($likedByUser)

                                <ion-icon name="heart"></ion-icon> Unlike

                            @else

                                <ion-icon name="heart-outline"></ion-icon> {{$post->likes->count()<=1?"Like":"Likes"}}

                            @endif
                        </a>
                        <ul class="py-1 shadow-lg rounded group-hover:opacity-100 group-hover:pointer-events-auto group-hover:visible invisible opacity-0 pointer-events-none absolute text-center bg-gray-700 text-white w-full">
                            @foreach($likedUseres as $user)

                                <li><a class="underline hover:no-underline" href="/profile/{{$user->username}}"> {{$user->username}}</a></li>

                            @endforeach
                        </ul>
                    </div>
                    <p class="flex justify-center items-center gap-3 comment cursor-pointer py-1 px-2 hover:bg-gray-300 text-center w-fit whitespace-nowrap">
                        {{$post->comments->count() > 0 ? $post->comments->count() : ""}}
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                        ️Comment
                    </p>

                    <a href="share/{{$post->id}}"
                       class="flex justify-center gap-3 items-center cursor-pointer py-1 px-2 rounded-l hover:bg-gray-300 text-center w-fit whitespace-nowrap">
                        {{\App\Models\Post::where('share_post_id', $post->id)->count()}}
                        <ion-icon name="share-social-outline"></ion-icon>
                        Share
                    </a>


                </div>
                <x-comment :post="$post"/>
            </div>
        </div>
    </section>


</div>
