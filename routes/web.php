<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrendsController as trends;
use App\Http\Controllers\ConversationController;
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


Route::get('/conversation/{pseudo}', [ConversationController::class,'convUser'])->middleware(['auth'])->name('convUser');

Route::get('/conversation', [ConversationController::class,'conversation'])->middleware(['auth'])->name('conversation');

Route::get('/formconv/{id}', [ConversationController::class,'formconv'])->middleware(['auth'])->name('formconv');

Route::post('/post/{id}',[ConversationController::class, 'post'])->middleware(['auth'])->name('post');
//Users routes
Route::get('/user/{pseudo}', [user::class,'posted'])->middleware(['auth'])->name('user');

Route::get('/user/{pseudo}/comments', [user::class,'comments'])->middleware(['auth'])->name('userComments');

Route::get('/user/{pseudo}/liked', [user::class,'liked'])->middleware(['auth'])->name('userLiked');

require __DIR__.'/auth.php';
