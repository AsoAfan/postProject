<x-layout>


    <div class="max-w-sm mx-auto px-6 my-12 p-6 text-center bg-gray-300 rounded-2xl">
        <h1 class="text-2xl font-bold mb-5">Register</h1>

        <form method="post" action="/register">
            @csrf

            <x-input type='text' name="name"
                     placeholder="Full name" id='name'>
                @error('name')
                <x-input-error>{{$message}}</x-input-error>
                @enderror


            </x-input>


            <x-input type='text' name="username"
                     placeholder='username' id='username'/>

            <x-input type='text' name="email"
                     placeholder='email address' id='email'/>

            <x-input type='password' name="password"
                     placeholder='password' id='password'/>

            <x-button class="bg-blue-500 text-white hover:bg-blue-700">Submit</x-button>
            <p class="mt-4 text-sm">Have an account?
                <a href="/login"
                   class="border-b border-black pb-0.5 hover:border-transparent">
                    Login
                </a>
            </p>

        </form>

    </div>

</x-layout>