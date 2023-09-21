<x-layout>
    <div class="flex flex-col items-center">
        <div onmouseleave="document.querySelector('.cover-inputs').classList.add('hidden')"
             class="group relative w-full h-44 flex justify-end items-end">
            <img class="absolute object-cover z-10 top-0 left-0 h-full w-full"
                 src="{{ asset("storage/".($user->cover_image ?? "cover/default.jpg")) }}" alt="cover image"/>

            @if($user->id === auth()->id())

                <x-button
                        class="z-40 group-hover:opacity-100 transition-all delay-0 duration-200 opacity-0 cover-upload relative flex px-2 py-2 mx-12 mb-12 w-1 items-center justify-center bg-white hover:bg-gray-100">
                    <ion-icon name="camera-outline" class="flex-shrink-0 h-6 w-6"></ion-icon>

                    <ul class="hidden z-50 cover-inputs flex flex-col absolute top-10 -right-1 w-80 rounded-xl shadow-xl border-t border-gray-300 bg-white">

                        <li class=" p-2 rounded-lg">

                            <form method="post" action="/cover" enctype="multipart/form-data">
                                @csrf

                                <label for="cover"
                                       class="hover:bg-gray-300/75 p-2 gap-2 rounded-lg flex items-center cursor-pointer">
                                    <ion-icon name="add-circle-outline" class="h-6 w-6"></ion-icon>
                                    <span>Upload Photo</span>
                                </label>
                                <input type="file" id="cover" class="hidden" name="cover_image"/>
                                <input type="submit" value="Confirm"
                                       class="bg-blue-500 text-white w-full hover:bg-blue-600 rounded-lg my-4 py-2">

                            </form>

                        </li>


                        @if(request()->file("cover_image"))
                            <li class="self-center">
                                <div class=" w-60 h-60 bg-gray-300 rounded"></div>
                                <input type="submit" value="Confirm"
                                       class="bg-blue-500 text-white w-full hover:bg-blue-600 rounded-lg my-4 py-2">
                            </li>

                        @endif

                    </ul>

                </x-button>
            @endif

        </div>

        <div class="text-center">
            <div>
                <div class="relative -mt-14 mb-2 w-40 h-40 bg-gray-300 rounded-full border-4 border-gray-800">

                    <img class="rounded-full z-20 absolute object-cover object-center top-0 left-0 h-full w-full"
                         src="{{ asset("storage/".($user->profile_image ?? "cover/default.jpg")) }}" alt="cover image"/>
                    @if($user->id === auth()->id())

                        <ion-icon name="image-outline"
                                  class="profile-btn absolute bottom-0 z-30 bg-gray-500 text-gray-200 cursor-pointer rounded-full right-0 p-2 w-6 h-6"></ion-icon>
                        <ul class="hidden z-20 profile-inputs flex flex-col items-center justify-center p-2 absolute top-0 -right-0 w-full h-full rounded-full shadow-xl border-t border-gray-300 bg-white">

                            <li class="rounded-lg">

                                <form method="post" action="/profile" enctype="multipart/form-data">
                                    @csrf

                                    <label for="profile"
                                           class="hover:bg-gray-300/75 rounded-lg p-2 gap-2 flex items-center cursor-pointer">
                                        {{--                                    <ion-icon name="add-circle-outline" class="h-6 w-6"></ion-icon>--}}
                                        <span>Upload Photo</span>
                                    </label>
                                    <input type="file" id="profile" class="hidden" name="profile_image"/>
                                    <input type="submit" value="✔️"
                                           class="text-white text-lg w-1/2 rounded-full my-2 p-2 cursor-pointer hover:bg-gray-200">
                                </form>
                            </li>


                            @if(request()->file("cover_image"))
                                <li class="self-center">
                                    <div class=" w-60 h-60 bg-gray-300 rounded"></div>
                                    <input type="submit" value="Confirm"
                                           class="bg-blue-500 text-white w-full hover:bg-blue-600 rounded-lg my-4 py-2">
                                </li>

                            @endif

                        </ul>
                    @endif


                </div>
            </div>

            <h2 class="text-3xl font-bold">{{$user->name}}</h2>
        </div>


        @if($user->id === auth()->id())

            <div class="w-full mb-12 p-4 flex flex-col">
                <div class="flex gap-3 flex-shrink-0 flex-grow">
                    <div>
                        <a href="/profile/{{auth()->user()->username}}">
                            <img src="{{asset('storage/'. (auth()->user()->profile_image ?? "profile/default.jpg"))}}"
                                 alt="profile_image"
                                 class="mb-4 self-center w-14 h-14 bg-gray-400 rounded-xl object-cover ">

                        </a></div>
                    <form class="w-4/5 text-right" method="post" action="/post" enctype="multipart/form-data">
                        @csrf
                        <textarea
                                class="w-full resize-none border-2 border-dashed border-gray-400 p-2 rounded-lg"
                                placeholder="what you are thinking about?"
                                name="body"
                        ></textarea>
                        <div class="flex justify-between items-center mt-6">

                            <input type="file" name="post_image" class="hidden" id="post_image">
                            <label for="post_image"
                                   class="flex items-center gap-3 p-2 bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg">
                                <ion-icon class="w-5 h-5" name="cloud-upload-outline"></ion-icon>
                                <span>Photo Upload</span>
                            </label>
                            <x-button
                                    class="bg-blue-500 text-white hover:bg-blue-600
                            !w-24 self-end">
                                Post
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

        @endif


        @error('cover_image')
        <p>{{$message}}</p>
        @enderror

    </div>

    <div class="mt-20">
    @foreach($posts as $post)

        <x-post :post="$post"/>

    @endforeach
    </div>
    {{--@dd(\App\Models\Post::where('user_id', $user->id)->get())--}}

    <script>

        // Cover image upload
        const coverUploadButton = document.querySelector('.cover-upload')
        const coverInput = document.querySelector('.cover-inputs')

        coverUploadButton.addEventListener('click', function () {
            coverInput.classList.toggle('hidden')

            document.addEventListener('click', function (e) {
                const isClicked = coverInput.contains(e.target)
                const isClicked1 = coverUploadButton.contains(e.target)

                if (!isClicked && !isClicked1) coverInput.classList.add('hidden')
            })
        })

        // profile image upload

        const profileImageUploadBtn = document.querySelector('.profile-btn')
        const profileInput = document.querySelector('.profile-inputs')

        profileImageUploadBtn.addEventListener('click', function () {
            profileInput.classList.toggle('hidden')

            document.addEventListener('click', function (e) {
                const isClicked = profileInput.contains(e.target)
                const isClicked1 = profileImageUploadBtn.contains(e.target)

                if (!isClicked && !isClicked1) profileInput.classList.add('hidden')
            })
        })
    </script>
</x-layout>