<?php

use App\Models\User;
use App\Models\Tweets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [TweetsController::class, 'index'])->middleware(['auth'])->name('home');

Route::post('/users/{user:username}/follow', [FollowController::class, 'store'])->middleware(['auth']);

// Route::post('/create-follow/{user:username}', [FollowController::class, 'createFollow'])->middleware(['auth']);
// Route::post('/remove-follow/{user:username}', [FollowController::class, 'removeFollow'])->middleware(['auth']);

Route::get('/register', function(){
    return view('register');
});

Route::get('/bookmark', function() {
    return view('bookmark');
})->middleware(['auth'])->name('bookmark');

Route::get('/explore', function() {
    return view('explore');
})->middleware(['auth'])->name('explore');

Route::get('/notification', function() {
    return view('notification');
})->middleware(['auth'])->name('notification');

Route::get('/message', function() {
    return view('message');
})->middleware(['auth'])->name('message');

Route::get('/list', function() {
    return view('list');
})->middleware(['auth'])->name('list');

Route::get('/edit', function() {
    return view('edit');
})->middleware(['auth'])->name('edit');

Route::get('/suggestion', [ProfileController::class, 'allUsers'])->middleware(['auth']);

Route::patch('/profile', [ProfileController::class, 'update']);

Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth'])->name('profile');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->middleware(['auth']);

Route::post('/', [TweetsController::class, 'store']);

Route::post('/register', [RegisterController::class, 'signin']);

Route::post('/login', [LoginController::class, 'login']);

Route::get('/login', function(){
    return view('login');
})->name('login');

 Route::get('/logout', [LoginController::class, 'logout']);


 Route::get('/tweet/{id}', [TweetsController::class, 'show']);
