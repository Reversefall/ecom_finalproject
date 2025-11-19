<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Khu vực ADMIN
// ->middleware(['auth', 'is_admin'])
Route::prefix('admin')->group(function () {
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    Route::get('/users/toggle-status/{id}', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
});

// Khu vực SELLER
// Khu vực USER