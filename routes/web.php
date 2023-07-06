<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserPostController;
use App\Models\User;
use App\Http\Controllers\PostController;
use App\Services\MailchimpNewsletter;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use MailchimpMarketing\ApiClient;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/authors/{user}', [UserPostController::class, 'show'])->name('user.posts.show');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Register & Login
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create']);
    Route::post('register', [RegisterController::class, 'store']);

    Route::get('login', [SessionsController::class, 'create'])->name('login');
    Route::post('login', [SessionsController::class, 'store']);
});
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

// User section
Route::middleware('auth')->group(function () {
    Route::post('/posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

    Route::get('user/posts', [UserPostController::class, 'index'])->name('user.posts.index');
    Route::post('user/posts', [UserPostController::class, 'store'])->name('user.posts.store');
    Route::get('user/posts/create', [UserPostController::class, 'create'])->name('user.posts.create');
    Route::get('user/posts/{post}/edit', [UserPostController::class, 'edit'])->name('user.posts.edit');
    Route::patch('user/posts/{post}', [UserPostController::class, 'update'])->name('user.posts.update');
    Route::delete('user/posts/{post}', [UserPostController::class, 'destroy'])->name('user.posts.destroy');
});

// Admin Section
Route::get('admin/posts', [AdminPageController::class, 'index'])->name('admin.index.posts');
Route::get('admin/users', [AdminPageController::class, 'index'])->name('admin.index.users');
Route::get('admin/comments', [AdminPageController::class, 'index'])->name('admin.index.comments');
