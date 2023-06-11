<?php

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
Route::get('/authors/{user}', [UserPostController::class, 'show']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::post('/posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

// Register & Login
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create']);
    Route::post('register', [RegisterController::class, 'store']);

    Route::get('login', [SessionsController::class, 'create']);
    Route::post('login', [SessionsController::class, 'store']);
});
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

// User section
Route::middleware('auth')->group(function () {
    Route::get('user/posts', [UserPostController::class, 'index']);
    Route::post('user/posts', [UserPostController::class, 'store']);
    Route::get('user/posts/create', [UserPostController::class, 'create']);
    Route::get('user/posts/{post}/edit', [UserPostController::class, 'edit']);
    Route::patch('user/posts/{post}', [UserPostController::class, 'update']);
    Route::delete('user/posts/{post}', [UserPostController::class, 'destroy']);
});

