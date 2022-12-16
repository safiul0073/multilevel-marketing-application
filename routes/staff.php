<?php

use App\Http\Controllers\Staff\Auth\CodeCheckController;
use App\Http\Controllers\Staff\Auth\ForgotPasswordController;
use App\Http\Controllers\Staff\Auth\ResetPasswordController;
use App\Http\Controllers\Staff\Auth\StaffController;
use App\Http\Controllers\Staff\CategoryController;
use App\Http\Controllers\Staff\EpinController;
use App\Http\Controllers\Staff\EpinHelperController;
use App\Http\Controllers\Staff\MediaController;
use App\Http\Controllers\Staff\ProductController;
use App\Http\Controllers\Staff\ProductHelperController;
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
    Route::resource('epin', EpinController::class);

    Route::post('epin-update', [EpinController::class, 'update']);
    Route::post('store-epin', [EpinHelperController::class, 'storeEpin']);
    Route::delete('delete-epin/{id}', [EpinHelperController::class, 'deleteEpin']);
    Route::get('product-list', [EpinHelperController::class, 'getProductList']);
    // product helper
    Route::post('product-update', [ProductController::class, 'update']);
    Route::get('product-images/{product}', [ProductHelperController::class, 'getProductImages']);

    Route::get('category-list', [ProductHelperController::class, 'getCategoryList']);
    Route::post('slider-update', [SliderController::class, 'update']);
    Route::post('category-update', [CategoryController::class, 'update']);
    // user Helper
    Route::get('binary-user', [UserHelperController::class, 'userBinaryTreeData']);
    Route::get('user-list', [UserHelperController::class, 'getUserList']);
    Route::get('user-details/{id}', [UserHelperController::class, 'userDetailsCalculation']);
    Route::post('user-password-reset', [UserHelperController::class, 'passwordReset']);
    Route::get('get-signle-user-tree/{user}', [UserHelperController::class, 'getOnlyUserBinaryTree']);

    // media
    Route::post('image-store', [MediaController::class, 'storeImage']);
    Route::delete('image-delete/{image}', [MediaController::class, 'deleteImage']);
});
