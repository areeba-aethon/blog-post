<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Route::get('/', function () {
//     return view('posts.index');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

// Route::middleware(['auth'])->group(function () {
//     Route::get('/', [PostController::class, 'index'])->name('posts.index'); // Home Page (Post List)
//     Route::resource('posts', PostController::class)->except(['index']); // CRUD for posts (except index)
// });


Route::middleware(['auth'])->group(function () {
Route::get('/', [PostController::class, 'index'])->name('home');
Route::resource('posts', PostController::class);
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/', [PostController::class, 'index'])->name('posts.index'); // List posts
//     Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // Show create form
//     Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // Store new post
//     Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show'); // Show single post
//     Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit'); // Show edit form
//     Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update'); // Update post
//     Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // Delete post
// });
