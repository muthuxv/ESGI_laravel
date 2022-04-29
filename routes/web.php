<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrendsController as trends;
use App\Http\Controllers\UserController as user;
use App\Http\Controllers\PostController as post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/trends', [trends::class,'trends'])->middleware(['auth'])->name('trends');

Route::get('/follow/{pseudo}',[user::class, 'follow'])->middleware(['auth'])->name('follow');

Route::get('/unfollow/{pseudo}',[user::class, 'unfollow'])->middleware(['auth'])->name('unfollow');

//Users routes
Route::get('/user/{pseudo}', [user::class,'posted'])->middleware(['auth'])->name('user');

Route::get('/user/{pseudo}/comments', [user::class,'comments'])->middleware(['auth'])->name('userComments');

Route::get('/user/{pseudo}/liked', [user::class,'liked'])->middleware(['auth'])->name('userLiked');

Route::get('/profile', [user::class,'profile'])->middleware(['auth'])->name('profile');

Route::post('/changeProfile', [user::class,'changeProfile'])->middleware(['auth'])->name('changeProfile');

//Post routes
Route::get('/createPost', [post::class,'create'])->middleware(['auth'])->name('createPost');

Route::post('/createPost/valid', [post::class,'validCreate'])->middleware(['auth'])->name('validCreate');

Route::get('/deletePost/{id}', [post::class,'delete'])->middleware(['auth'])->name('delete');

Route::get('/post/{id}', [post::class,'post'])->middleware(['auth'])->name('post');

Route::get('/deleteCom/{id}', [post::class,'deleteCom'])->middleware(['auth'])->name('deleteCom');

Route::post('/comment/{id}', [post::class,'comment'])->middleware(['auth'])->name('comment');

Route::get('/like/{id}', [post::class,'like'])->middleware(['auth'])->name('like');

require __DIR__.'/auth.php';
