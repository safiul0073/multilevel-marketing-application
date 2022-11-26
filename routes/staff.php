<?php

use App\Http\Controllers\Staff\CategoryController;
use App\Http\Controllers\Staff\ProductController;
use App\Http\Controllers\Staff\SliderController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Staff\UserController;
use Illuminate\Support\Facades\Route;

// api route start for dashboard
// auth route start ...
Route::post('/login', [StaffController::class, 'login'])->name('login');
Route::middleware('auth:staff')->group(function () {
    Route::get('/me', [StaffController::class, 'me'])->name('me');
    Route::post('/logout', [StaffController::class, 'logout'])->name('logout');

    // category section
    Route::resource('category', CategoryController::class);
    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class);
    Route::resource('slider', SliderController::class);
});
