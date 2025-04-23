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
