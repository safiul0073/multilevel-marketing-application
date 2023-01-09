<?php

use App\Http\Controllers\Staff\V1\Auth\CodeCheckController;
use App\Http\Controllers\Staff\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\Staff\V1\Auth\ResetPasswordController;
use App\Http\Controllers\Staff\V1\Auth\StaffController;
use App\Http\Controllers\Staff\V1\CategoryController;
use App\Http\Controllers\Staff\V1\EpinController;
use App\Http\Controllers\Staff\V1\EpinHelperController;
use App\Http\Controllers\Staff\V1\MediaController;
use App\Http\Controllers\Staff\V1\OptionController;
use App\Http\Controllers\Staff\V1\PackageController;
use App\Http\Controllers\Staff\V1\PackageHelperController;
use App\Http\Controllers\Staff\V1\RewardController;
use App\Http\Controllers\Staff\V1\SliderController;
use App\Http\Controllers\Staff\V1\UserController;
use App\Http\Controllers\Staff\V1\UserHelperController;
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

    // resource route start
    Route::resource('category', CategoryController::class);

    Route::resource('package', PackageController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('epin', EpinController::class);
    Route::resource('reward', RewardController::class);
    // resource route end

    Route::post('reward-update', [RewardController::class, 'update']);
    // epin helper
    Route::post('epin-update', [EpinController::class, 'update']);
    Route::post('store-epin', [EpinHelperController::class, 'storeEpin']);
    Route::delete('delete-epin/{id}', [EpinHelperController::class, 'deleteEpin']);
    // package helper
    Route::get('package-list', [EpinHelperController::class, 'getProductList']);
    Route::get('all-package', [PackageHelperController::class, 'getAllPackage']);
    Route::post('package-update', [PackageController::class, 'update']);
    Route::get('package-images/{product}', [PackageHelperController::class, 'getProductImages']);

    // category and slider helper
    Route::get('category-list', [PackageHelperController::class, 'getCategoryList']);
    Route::post('slider-update', [SliderController::class, 'update']);
    Route::post('category-update', [CategoryController::class, 'update']);


    // user route list
    Route::prefix('user')->name('user.')->group(function () {
        Route::resource('/', UserController::class);
        Route::post('info/update', [UserController::class, 'update'])->name('info.update');
        Route::get('referral-list/{user}', [UserHelperController::class, 'userReferrals']);
        // user Helper
        Route::get('binary', [UserHelperController::class, 'userBinaryTreeData']);
        Route::get('list', [UserHelperController::class, 'getUserList']);
        Route::get('details/{id}', [UserHelperController::class, 'userDetailsCalculation']);
        Route::post('password-reset', [UserHelperController::class, 'passwordReset']);
        // balance increment or decrement
        Route::post('balance/add-sub/{user}', [UserHelperController::class, 'userBalanceUpdate']);
    });
    // media
    Route::post('image-store', [MediaController::class, 'storeImage']);
    Route::delete('image-delete/{image}', [MediaController::class, 'deleteImage']);

    // settings
    Route::prefix('settings/')->group(function () {
        Route::get('bonus', [OptionController::class, 'getBonus']);
        Route::post('bonus',[OptionController::class, 'storeOption']);
    });
});
