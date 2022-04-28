<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrendsController as trends;
use App\Http\Controllers\UserController as user;

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

require __DIR__.'/auth.php';
