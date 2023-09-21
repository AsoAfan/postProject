<x-layout>
    @auth

        <div class="mb-12 p-4 flex flex-col">
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
                        <label for="post_image" class="flex items-center gap-3 p-2 bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg">
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

        <div>

            @foreach($posts as $post)

                <x-post :post="$post"/>

            @endforeach

            @endauth
        </div>


</x-layout>