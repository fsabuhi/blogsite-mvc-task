<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('posts', [PostController::class, 'index'])->name('posts'); // List all posts
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create'); // Show create post form
    Route::post('posts/create', [PostController::class, 'store'])->name('posts.store'); // Handle post creation
    Route::delete('posts/{id}', [PostController::class, 'delete'])->name('posts.delete');

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';