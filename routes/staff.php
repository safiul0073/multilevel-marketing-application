<?php

use App\Http\Controllers\Staff\Auth\CodeCheckController;
use App\Http\Controllers\Staff\Auth\ForgotPasswordController;
use App\Http\Controllers\Staff\Auth\ResetPasswordController;
use App\Http\Controllers\Staff\Auth\StaffController;
use App\Http\Controllers\Staff\CategoryController;
use App\Http\Controllers\Staff\ProductController;
use App\Http\Controllers\Staff\SliderController;
use App\Http\Controllers\Staff\UserController;
use App\Http\Controllers\Staff\UserHelperController;
use Illuminate\Support\Facades\Route;

// api route start for dashboard
// auth route start ...
Route::get('test', function () {
    return response()->json([
        "message" => "Hello world! staff"
    ]);
});
Route::post('/login', [StaffController::class, 'login'])->name('login');
 // Password reset routes
 Route::post('password/email',  ForgotPasswordController::class);
 Route::post('password/code/check', CodeCheckController::class);
 Route::post('password/reset', ResetPasswordController::class);
Route::middleware('auth:staff')->group(function () {
    Route::get('/me', [StaffController::class, 'me'])->name('me');
    Route::post('/logout', [StaffController::class, 'logout'])->name('logout');

    // category section
    Route::resource('category', CategoryController::class);
    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class);
    Route::resource('slider', SliderController::class);
    Route::post('product-update', [ProductController::class, 'update']);
    Route::post('slider-update', [SliderController::class, 'update']);
    Route::post('category-update', [CategoryController::class, 'update']);
    // user Helper
    Route::get('binary-user', [UserHelperController::class, 'userBinaryTreeData']);
});
