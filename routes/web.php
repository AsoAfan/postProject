<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\SharedPost;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {

    $posts = Post::latest()->get();


    return view('index', [
        'posts' => $posts
    ]);
})->middleware('auth');

Route::get('login', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');
Route::get('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get("register", [RegisterController::class, 'create'])->middleware('guest');
Route::post("register", [RegisterController::class, 'store'])->middleware('guest');

Route::get('profile/{username}', function ($username) {
    return view('components.profile', [
        'user' => User::where('username', $username)->first(),
        'posts' => Post::where('user_id', User::where('username', $username)->first()->id)->latest()->get()
    ]);
})->middleware('auth');

Route::post('cover', [UserController::class, 'storeCover'])->middleware('auth');
Route::post('profile', [UserController::class, 'storeProImage'])->middleware('auth');

Route::post('post', [PostController::class, 'store']);
Route::get('delete/{id}', [PostController::class, 'destroy'])->middleware('auth');
Route::get('like/{id}', [LikeController::class, 'like'])->middleware('auth');

Route::post('comment/{post}', [CommentController::class, 'store'])->middleware('auth');
Route::get('share/{id}', [PostController::class, 'share'])->middleware('auth');

Route::get('shared', function () {
    $shared = SharedPost::latest()->get();

    $posts = Post::latest()->get();
    $pot = $posts->concat($shared);

    dd($pot[12]);
})->middleware('auth');