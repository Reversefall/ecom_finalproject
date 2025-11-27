<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Moderator\ModeratorDashboardController;
use App\Http\Controllers\Moderator\ModeratorGroupController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerGroupController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserGroupController;
use App\Http\Controllers\User\UserOrderController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/chat', [HomeController::class, 'chat'])->name('chat');

Route::get('/groups', [HomeController::class, 'groups'])->name('groups');
Route::get('/groups/{id}', [HomeController::class, 'detailGroups'])->name('groups.detail');

Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/products/{id}', [HomeController::class, 'detail'])->name('products.detail');

Route::get('/detailSeller/{id}', [HomeController::class, 'detailSeller'])->name('detailSeller');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/vnpay/return', [UserOrderController::class, 'vnpayReturn'])->name('vnpayReturn');

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

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/detail/{id}', [AdminOrderController::class, 'detail'])->name('admin.orders.detail');
    Route::post('/orders/toggle-status', [AdminOrderController::class, 'toggleStatus'])->name('admin.orders.update-status');
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

    Route::get('/groups', [SellerGroupController::class, 'index'])->name('seller.groups.index');
    Route::get('/groups/detail/{id}', [SellerGroupController::class, 'detail'])->name('seller.groups.detail');
    Route::get('/groups/payments/:id', [SellerGroupController::class, 'payments'])->name('seller.groups.payments');
    Route::get('/groups/chat/{id}', [SellerGroupController::class, 'chat'])->name('seller.groups.chat');
    Route::post('/groups/chat/{id}', [SellerGroupController::class, 'send'])->name('seller.groups.send');


    Route::get('/orders', [SellerOrderController::class, 'index'])->name('seller.orders.index');
    Route::get('/orders/detail/{id}', [SellerOrderController::class, 'detail'])->name('seller.orders.detail');
});

// Khu vực MODERATOR

Route::prefix('moderator')->middleware(['auth', 'is_moderator'])->group(function () {
    Route::get('/dashboard', [ModeratorDashboardController::class, 'index'])->name('moderator.dashboard');
    Route::get('/groups', [ModeratorGroupController::class, 'index'])->name('moderator.groups.index');
    Route::get('/groups/detail/{id}', [ModeratorGroupController::class, 'detail'])->name('moderator.groups.detail');
    Route::post('/groups/toggle-status/{id}', [ModeratorGroupController::class, 'updateStatus'])->name('moderator.groups.updateStatus');
});

// Khu vực USER
Route::prefix('user')->middleware(['auth', 'is_user'])->group(function () {
    Route::get('/groups', [UserGroupController::class, 'index'])->name('user.groups.index');
    Route::get('/groups/create/{id}', [UserGroupController::class, 'create'])->name('user.groups.create');
    Route::post('/groups/store/{product}', [UserGroupController::class, 'store'])->name('user.groups.store');
    Route::get('/groups/join/{id}', [UserGroupController::class, 'joinGroup'])->name('user.groups.join');
    Route::get('/groups/chat/{id}', [UserGroupController::class, 'chat'])->name('user.groups.chat');
    Route::post('/groups/chat/{id}', [UserGroupController::class, 'send'])->name('user.groups.send');
    Route::post(
        '/groups/leave/{groupId}',
        [UserGroupController::class, 'leaveGroup']
    )
        ->name('user.groups.leave');

    Route::get('/cart', [UserCartController::class, 'index'])->name('user.orders.cart');
    Route::post('/cart/update-quantity/{group}', [UserCartController::class, 'updateQuantity'])->name('user.cart.updateQuantity');
    Route::post('/cart/checkout', [UserCartController::class, 'checkout'])->name('user.cart.checkout');

    Route::get('/orders', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::get('/orders/detail/{id}', [UserOrderController::class, 'detail'])->name('user.orders.detail');
    Route::post('/orders/payments', [UserOrderController::class, 'storePayment'])->name('user.orders.payments.store');
});
