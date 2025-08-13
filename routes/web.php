<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'posts');

// Admin Routes MUST come BEFORE resource routes to avoid conflicts
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () { 
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard'); 
    Route::get('/users', [AdminController::class, 'users'])->name('users'); 
    Route::get('/posts', [AdminController::class, 'posts'])->name('posts'); 
    Route::get('/comments', [AdminController::class, 'comments'])->name('comments');

    // Admin post management routes
    Route::get('/posts/create', [AdminController::class, 'createPost'])->name('posts.create');
    Route::get('/posts/{post}', [AdminController::class, 'showPost'])->name('posts.show');
    Route::get('/posts/{post}/edit', [AdminController::class, 'editPost'])->name('posts.edit');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::put('/posts/{post}/update', [PostController::class, 'update'])->name('posts.update');

    // AJAX routes for updates
    Route::put('/users/{user}/role', [AdminController::class, 'updateUserRole'])->name('users.update-role');
    Route::put('/posts/{post}/category', [AdminController::class, 'updatePostCategory'])->name('posts.update-category');

    // Delete routes
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.destroy');
    Route::delete('/comments/{comment}', [AdminController::class, 'deleteComment'])->name('comments.destroy');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Public and user routes
Route::resource('posts', PostController::class);
Route::get('/{user}/posts', [DashboardController::class, 'userPosts'])->name('posts.user');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/posts/{post}/toggle-like', [PostController::class, 'toggleLike'])->name('posts.toggle-like');
    Route::post('/posts/{post}/store-comment', [PostController::class, 'storeComments'])->name('posts.store-comment');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});