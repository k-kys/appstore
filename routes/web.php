<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::get('grid', function () {
    return view('app.grid');
});


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister'])->name('postRegister');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('profile/{id}', [UserController::class, 'profile'])->name('profile');
Route::put('profile/{id}', [UserController::class, 'postProfile'])->name('postProfile');
Route::get('change-password/{id}', [UserController::class, 'changePassword'])->name('changePassword');

Route::get('/', [AppController::class, 'index'])->name('app.index');
Route::get('show/{id}', [AppController::class, 'show'])->name('app.show');
Route::get('create', [AppController::class, 'create'])->name('app.create');
Route::put('store', [AppController::class, 'store'])->name('app.store');
Route::get('my-apps/{id}', [AppController::class, 'myApps'])->name('app.myApps');

Route::get('timkiem/{keyword}', [AppController::class, 'search'])->name('app.search');
Route::get('search', function () {
    return view('test.search');
});

Route::get('cart', [AppController::class, 'cart']);
Route::get('add-to-cart/{id}', [AppController::class, 'addToCart']);
Route::patch('update-cart', [AppController::class, 'updateCart']);
Route::delete('remove-from-cart', [AppController::class, 'removeCart']);
