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

//Users routes
Route::get('/user/{pseudo}', [user::class,'posted'])->middleware(['auth'])->name('user');

Route::get('/user/{pseudo}/comments', [user::class,'comments'])->middleware(['auth'])->name('userComments');

Route::get('/user/{pseudo}/liked', [user::class,'liked'])->middleware(['auth'])->name('userLiked');

//Post routes
Route::get('/createPost', [post::class,'create'])->middleware(['auth'])->name('createPost');
Route::post('/createPost/valid', [post::class,'validCreate'])->middleware(['auth'])->name('validCreate');
Route::get('/deletePost/{id}', [post::class,'delete'])->middleware(['auth'])->name('delete');

require __DIR__.'/auth.php';
