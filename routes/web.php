<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// })->name('home');
Route::get('/', [UserController::class, 'index'])->name('home');

// Route::get('/posts', [PostController::class, 'update'])->name('posts.index');

Route::get('/posts/create', function () {
    return view('posts.create');
})->name('posts.create');
// Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Route::get('/posts/show', function () {
//     return view('posts.show');
// });

// Route::get('/posts/edit', function () {
//     return view('posts.edit');
// });
// Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Routes for authenticated users only
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //Posts
    // Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require_once __DIR__.'/auth.php';
