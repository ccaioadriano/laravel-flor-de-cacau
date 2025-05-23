<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/sobre', function () {
    return view('pages.about');
})->name('about');

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/create',[ProductController::class, 'create'])->name('create_product')->middleware('auth');
Route::get('/dashboard/search', [DashboardController::class, 'search'])->name('dashboard.search')->middleware('auth');

Route::middleware(['auth'])->post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->post('/store', [ProductController::class, 'store'])->name('store_product');
Route::middleware(['auth'])->put('updateProduct/{product}', [ProductController::class, 'updateProduct'])->name('update_product');
Route::middleware(['auth'])->put('updateImage/{product}', [ProductController::class, 'updateImage'])->name('update_image');
Route::middleware(['auth'])->put('updatePrice/{product}', [ProductController::class, 'updatePrice'])->name('update_price');
Route::middleware(['auth'])->delete('deleteProduct/{product}/delete', [ProductController::class, 'deleteProduct'])->name('delete_product');
Route::middleware(['auth'])->put('unlink-product/{product}', [DashboardController::class, 'unlinkProduct'])->name('unlink_product');
Route::middleware(['auth'])->put('link-product-to-category/{product}', [DashboardController::class, 'linkProduct'])->name('link_product');
