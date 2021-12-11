<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\LoginController,
    Auth\RegisterController,
    PostController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [PostController::class, 'index'])->name('home');

Route::name('auth.')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('login')->name('login.')->group(function () {
        Route::get('/', [LoginController::class, 'showLoginForm'])->name('index');
        Route::post('/', [LoginController::class, 'login'])->name('login');
    });

    Route::prefix('register')->name('register.')->group(function () {
        Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('index');
        Route::post('/', [RegisterController::class, 'register'])->name('register');
    });
});

Route::prefix('post')->name('post.')->group(function () {
    //need login
    Route::middleware('auth')->group(function () {
        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::post('store', [PostController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('{id}', [PostController::class, 'update'])->name('update');
        Route::delete('{id}', [PostController::class, 'destroy'])->name('destroy');
    });

    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('{id}', [PostController::class, 'show'])->name('show');
});





