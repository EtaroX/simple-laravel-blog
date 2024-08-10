<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\PostController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->resource('posts', \App\Http\Controllers\PostController::class);
Route::middleware('auth')->post('/posts/{postId}/like', [\App\Http\Controllers\PostController::class, 'like'])->name('posts.like');
Route::middleware('auth')->post('/posts/{postId}/dislike', [\App\Http\Controllers\PostController::class, 'dislike'])->name('posts.dislike');

require __DIR__.'/auth.php';
