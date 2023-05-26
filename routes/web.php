<?php

use App\Models\User;
use App\Models\Tweets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\RegisterController;

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

//Home & Post
Route::get('/', [TweetsController::class, 'index'])->middleware(['auth'])->name('home');
Route::post('/', [TweetsController::class, 'store']);
//Followers
Route::post('/users/{user:username}/follow', [FollowController::class, 'store'])->middleware(['auth']);

// Bookmark
Route::get('/bookmark', [BookmarkController::class, 'show'])->middleware(['auth'])->name('bookmark');
Route::post('/bookmark', [BookmarkController::class, 'store'])->middleware('auth');
Route::delete('/bookmark/{id}', [BookmarkController::class, 'destroy'])->middleware('auth');

//others
Route::get('/explore', function() {
    return view('explore');
})->middleware(['auth'])->name('explore');

Route::get('/notification', function() {
    return view('notification');
})->middleware(['auth'])->name('notification');

Route::get('/message', function() {
    return view('message');
})->middleware(['auth'])->name('message');

//Account edit
Route::patch('/edit', [EditController::class, 'update'])->middleware(['auth']);
Route::get('/edit', [EditController::class, 'index'])->middleware(['auth'])->name('edit');
Route::delete('/edit/{id}', [EditController::class, 'destroy'])->middleware(['auth']);

//COMMENT
Route::post('/comment', [CommentsController::class, 'store'])->middleware(['auth']);
Route::get('/comment/delete/{id}', [CommentsController::class, 'destroy'])->middleware(['auth']);

//users list
Route::get('/list', [ProfileController::class, 'allUsers'])->middleware(['auth']);

//Profile and profile edit
Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth'])->name('profile');
Route::patch('/profile', [ProfileController::class, 'update'])->middleware(['auth']);
Route::get('/profile/{id}', [ProfileController::class, 'show'])->middleware(['auth']);

//Register 
Route::get('/register', function(){
    return view('register');
});
Route::post('/register', [RegisterController::class, 'signin']);

//Login & log-out
Route::get('/login', function(){
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

//Single tweet and delete
Route::get('/delete/{id}', [TweetsController::class, 'destroy'])->middleware(['auth']);
Route::get('/tweet/{id}', [TweetsController::class, 'show'])->middleware(['auth']);
