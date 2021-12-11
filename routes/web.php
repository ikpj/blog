<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\LoginController,
    Auth\RegisterController
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login.index');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');

