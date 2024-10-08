<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('posts.index');
    }
    return view('welcome');
});


Route::middleware('auth')->group(function () {
Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('posts', PostController::class);
    Route::get('/posts/{postId}/like', [PostController::class, 'getLikes'])->whereNumber('postId')->name('posts.getLikes');
    Route::post('/posts/{postId}/like', [PostController::class, 'like'])->whereNumber('postId')->name('posts.like');
    Route::get('/posts/{postId}/dislike', [PostController::class, 'getDislikes'])->whereNumber('postId')->name('posts.getDislikes');
    Route::post('/posts/{postId}/dislike', [PostController::class, 'dislike'])->whereNumber('postId')->name('posts.dislike');

});


require __DIR__ . '/auth.php';
