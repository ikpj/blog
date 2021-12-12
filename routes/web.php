<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\LoginController,
    Auth\RegisterController,
    Auth\AdminLoginController,
    Admin\HomeController as AdminHomeController,
    Admin\ProfileController as AdminProfileController,
    Admin\AdminController as AdminAdminController,
    Admin\PostController as AdminPostController,
    Admin\UserController as AdminUserController,
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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::name('auth.')->group(function () {
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
        Route::prefix('login')->name('login.')->group(function () {
            Route::get('/', [AdminLoginController::class, 'showLoginForm'])->name('index');
            Route::post('/', [AdminLoginController::class, 'login'])->name('login');
        });
    });

    Route::middleware('auth:admin')->group(function () {
        //need login
        Route::get('/', [AdminHomeController::class, 'index'])->name('home');

        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [AdminProfileController::class, 'edit'])->name('edit');
            Route::put('/', [AdminProfileController::class, 'update'])->name('update');
            Route::get('password/edit', [AdminProfileController::class, 'editPassword'])->name('editPassword');
            Route::put('password/update', [AdminProfileController::class, 'updatePassword'])->name('updatePassword');
        });

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('create', [AdminUserController::class, 'create'])->name('create');
            Route::post('store', [AdminUserController::class, 'store'])->name('store');
            Route::get('{id}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::put('{id}', [AdminUserController::class, 'update'])->name('update');
            Route::delete('{id}', [AdminUserController::class, 'destroy'])->name('destroy');
            Route::patch('{id}', [AdminUserController::class, 'restore'])->name('restore');
            Route::delete('{id}/post', [AdminUserController::class, 'destroyAllPost'])->name('destroyAllPost');
        });

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [AdminAdminController::class, 'index'])->name('index');
            Route::get('create', [AdminAdminController::class, 'create'])->name('create');
            Route::post('store', [AdminAdminController::class, 'store'])->name('store');
            Route::get('{id}/edit', [AdminAdminController::class, 'edit'])->name('edit');
            Route::put('{id}', [AdminAdminController::class, 'update'])->name('update');
            Route::delete('{id}', [AdminAdminController::class, 'destroy'])->name('destroy');
            Route::patch('{id}', [AdminAdminController::class, 'restore'])->name('restore');
        });

        Route::prefix('post')->name('post.')->group(function () {
            Route::get('/', [AdminPostController::class, 'index'])->name('index');
            Route::get('{id}', [AdminPostController::class, 'show'])->name('show');
            Route::get('{id}/edit', [AdminPostController::class, 'edit'])->name('edit');
            Route::put('{id}', [AdminPostController::class, 'update'])->name('update');
            Route::delete('{id}', [AdminPostController::class, 'destroy'])->name('destroy');
            Route::patch('{id}', [AdminPostController::class, 'restore'])->name('restore');
        });

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
        Route::get('my', [PostController::class, 'my'])->name('my');
    });

    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('{id}', [PostController::class, 'show'])->name('show');
});





