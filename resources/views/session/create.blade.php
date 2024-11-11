<x-layout>
    <div class="mx-auto max-w-sm px-6 my-12 p-6 text-center bg-gray-400 rounded-2xl">
        <h1 class="text-2xl font-bold mb-5">Login</h1>

        <form method="post" action="/login">
            @csrf

            <x-input type='text' name="username"
                     placeholder='username' id='username'/>

            <x-input type='password' name="password"
                     placeholder='password' id='password'/>

            <x-button class="bg-blue-500 text-white hover:bg-blue-700">Login</x-button>
            <p class="mt-4 text-sm">New here? <a href="/register"
                                                 class="border-b border-black pb-0.5 hover:border-transparent">Register
                    now</a></p>


        </form>

    </div>
</x-layout>
