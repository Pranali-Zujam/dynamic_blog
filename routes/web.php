<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BlogController as ControllersBlogController;
use App\Http\Controllers\BlogInteractionController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Home
Route::get('/', function () {
    return view('auth.login');
});


// Authenticated User Routes
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('blogs.index');
    })->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // Like & Comment
    Route::post('/blogs/{blog}/like', [BlogInteractionController::class, 'like'])
        ->name('blogs.like');

    Route::post('/blogs/{blog}/comment', [BlogInteractionController::class, 'comment'])
        ->name('blogs.comment');
});


// Admin Routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', CategoryController::class)
            ->except(['show']);

        Route::resource('tags', TagController::class)
            ->except(['show']);

        Route::resource('blogs', BlogController::class)
            ->except(['show']);

        // User Management
        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/{user}', [UserController::class, 'show'])
            ->name('users.show');
        Route::post(
            '/blogs/content-image',
            [BlogController::class, 'contentImage']
        )->name('blogs.content-image');

        // Comment Management
        Route::get('/comments', [CommentController::class, 'index'])
            ->name('comments.index');

        Route::patch('/comments/{comment}/hide', [CommentController::class, 'hide'])
            ->name('comments.hide');

        Route::patch('/comments/{comment}/show', [CommentController::class, 'show'])
            ->name('comments.show');

        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
            ->name('comments.destroy');
    });


// Public Blog Routes
Route::get('/blogs', [ControllersBlogController::class, 'index'])
    ->name('blogs.index');

Route::get('/blogs/{slug}', [ControllersBlogController::class, 'show'])
    ->name('blogs.show');


// Google Login
Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('google.callback');


require __DIR__ . '/auth.php';
