<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerProductController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/chat', [HomeController::class, 'chat'])->name('chat');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/products/{id}', [HomeController::class, 'detail'])->name('products.detail');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Khu vực ADMIN
// 
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users/store', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/update/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::get('/users/toggle-status/{id}', [AdminUserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
});

// Khu vực SELLER

Route::prefix('seller')->middleware(['auth', 'is_seller'])->group(function () {
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('seller.dashboard');

    Route::get('/products', [SellerProductController::class, 'index'])->name('seller.products.index');
    Route::get('/products/create', [SellerProductController::class, 'create'])->name('seller.products.create');
    Route::post('/products/store', [SellerProductController::class, 'store'])->name('seller.products.store');
    Route::get('/products/edit/{id}', [SellerProductController::class, 'edit'])->name('seller.products.edit');
    Route::put('/products/update/{id}', [SellerProductController::class, 'update'])->name('seller.products.update');
    Route::get('/products/toggle-status/{id}', [SellerProductController::class, 'toggleStatus'])->name('seller.products.toggle-status');
    Route::delete('/products/images/{image}', [SellerProductController::class, 'destroyImage'])
        ->name('seller.products.images.destroy');
});

// Khu vực USER