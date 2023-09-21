<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="relative">
<div class="hidden md:block md:text-center md:my-24">

    <p class="text-3xl font-bold">Please use your phone to access this page</p>

</div>
<div class="md:hidden">
    <header class="flex justify-between items-center p-3">
        <div>
            <h1 class="font-bold text-2xl">BrandLogo</h1>
        </div>
        @auth
            <nav>
                <div class="flex flex-col md:!flex-row gap-1 cursor-pointer">
                    <div class="mob space-y-1 md:hidden">
                        <span class="w-6 h-1 bg-gray-900 block rounded-full"></span>
                        <span class="w-6 h-1 bg-gray-900 block rounded-full"></span>
                        <span class="w-6 h-1 bg-gray-900 block rounded-full"></span>
                    </div>

                    <ul
                            class="z-50 nav-mob hidden absolute cursor-default flex-col justify-between space-y-3 bg-gray-500 p-3 top-12 right-3
                    md:static md:top-0 md:flex md:flex-row md:gap-8 md:bg-transparent md:h-fit md:space-y-0">
                        <li class="border-b border-gray-200 md:border-none pb-2 md:pt-0"><a
                                    class="flex items-center gap-4"
                                    href="/profile/{{auth()->user()->username}}">

                                <img class="w-7 h-7 rounded"
                                     src="{{asset("storage/". (auth()->user()->profile_image ?? "profile/default.jpg"))}}"/>

                                {{auth()->user()->username}}
                            </a></li>
                        <li><a href="/home">Home</a></li>
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                </div>


            </nav>
        @endauth
    </header>
    <main class="">
        {{$slot}}
    </main>


    @if(session('success'))

        <p class="bg-green-700 text-white p-3 fixed bottom-4 right-4 rounded-xl">{{session('success')}}</p>

    @endif
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>

    // navigation mobile
    const icons = document.querySelector('.mob')
    const nav = document.querySelector('.nav-mob')

    icons.addEventListener('click', function () {
        nav.classList.toggle('hidden')
    })

    document.querySelector('main').addEventListener('click', function () {
        nav.classList.add('hidden')
    })

    // comment section

    const commentButton = document.querySelectorAll('.comment')
    const commentInput = document.querySelectorAll('.comment-input')


    for (let i = 0; i < commentButton.length; i++) {
        commentButton[i].addEventListener('click', function () {
            commentInput[i].classList.toggle('hidden')
        })


        document.addEventListener('click', function (event) {
            const isCommentInputClicked = commentInput[i].contains(event.target);
            const isCommentButtonClicked = commentButton[i].contains(event.target);

            if (!isCommentInputClicked && !isCommentButtonClicked) {
                commentInput[i].classList.add('hidden');
            }
        })
    }

    // more post info

    const moreBtn = document.querySelectorAll('.more-btn')
    const morList = document.querySelectorAll('.more')


    for (let i = 0; i < commentButton.length; i++) {
        moreBtn[i].addEventListener('click', function () {
            morList[i].classList.toggle('hidden')

            document.addEventListener('click', function (e) {
                const isClicked = morList[i].contains(e.target)
                const isClicked1 = moreBtn[i].contains(e.target)

                if (!isClicked && !isClicked1) morList[i].classList.add('hidden')
            })
        })

    }

</script>
</body>
</html>