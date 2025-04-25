<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/sobre', function () {
    return view('pages.about');
})->name('about');

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard')->middleware('auth');

Route::middleware(['auth'])->post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->put('updateProduct/{product}', [ProductController::class, 'updateProduct'])->name('updateProduct');
Route::middleware(['auth'])->put('updateImage/{product}', [ProductController::class, 'updateImage'])->name('updateImage');
Route::middleware(['auth'])->put('updatePrice/{product}', [ProductController::class, 'updatePrice'])->name('updatePrice');
Route::middleware(['auth'])->delete('updatePrice/{product}/delete', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
