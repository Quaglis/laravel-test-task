<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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

Route::get('register', [IndexController::class, 'register']);
Route::get('login', [IndexController::class, 'login'])->name('login');

Route::get('logout', [AuthController::class, 'logout']);
Route::post('registration', [AuthController::class, 'registration']);
Route::post('authentication', [AuthController::class, 'authentication']);

Route::middleware(['auth'])->group(function () {

    Route::get('/', [IndexController::class, 'index']);
    Route::get('index', [IndexController::class, 'index']);

    Route::get('profile', [IndexController::class, 'profile']);

    Route::get('post/{postId}', [IndexController::class, 'getPost']);

    Route::get('email/verify', [EmailController::class, 'emailVerifyNotice'])
        ->name('verification.notice');


    Route::middleware(['verified'])->group(function () {
        Route::get('edit-profile', [IndexController::class, 'editProfile']);
        Route::post('api/edit-profile', [AuthController::class, 'editUser']);
        Route::post('api/edit-password', [AuthController::class, 'editPassword']);

        Route::get('post-create', [IndexController::class, 'postCreate']);
        Route::post('api/post-create', [PostController::class, 'create']);

        Route::get('post-edit/{postId}', [IndexController::class, 'postEdit']);
        Route::post('api/post-edit', [PostController::class, 'edit']);
        Route::get('api/post-image-remove/{postId}', [PostController::class, 'removeImage']);
        Route::get('api/post-remove/{postId}', [PostController::class, 'remove']);
    });
});

Route::get('/email/verify/{id}/{hash}', [EmailController::class, 'emailVerifyHandler'])
    ->name('verification.verify');
