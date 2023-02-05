<?php

use App\Http\Controllers\Staff\V1\Auth\CodeCheckController;
use App\Http\Controllers\Staff\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\Staff\V1\Auth\ResetPasswordController;
use App\Http\Controllers\Staff\V1\Auth\StaffController;
use App\Http\Controllers\Staff\V1\CategoryController;
use App\Http\Controllers\Staff\V1\EpinController;
use App\Http\Controllers\Staff\V1\EpinHelperController;
use App\Http\Controllers\Staff\V1\InceptiveBonusController;
use App\Http\Controllers\Staff\V1\LoginInfo;
use App\Http\Controllers\Staff\V1\MediaController;
use App\Http\Controllers\Staff\V1\Settings\OptionController;
use App\Http\Controllers\Staff\V1\PackageController;
use App\Http\Controllers\Staff\V1\PackageHelperController;
use App\Http\Controllers\Staff\V1\PaymentMethodController;
use App\Http\Controllers\Staff\V1\Reports\BonusController;
use App\Http\Controllers\Staff\V1\Reports\WithdrawController;
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
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('payment-method', PaymentMethodController::class);
    Route::apiResource('package', PackageController::class);
    Route::apiResource('slider', SliderController::class);
    Route::apiResource('epin', EpinController::class);
    Route::apiResource('reward', RewardController::class);
    // resource route end

    Route::post('payment-method-update', [PaymentMethodController::class, 'update']);
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
        Route::get('reward/{id}', [UserHelperController::class, 'getUserReward']);
        Route::post('info/update', [UserController::class, 'update'])->name('info.update');
        Route::get('referral-list/{user}', [UserHelperController::class, 'userReferrals']);
        // user Helper
        Route::post('status/update/{user}', [UserHelperController::class, 'userStatusUpdate']);
        Route::get('binary', [UserHelperController::class, 'userBinaryTreeData']);
        Route::get('list', [UserHelperController::class, 'getUserList']);
        Route::get('details/{id}', [UserHelperController::class, 'userDetailsCalculation']);
        Route::post('password-reset', [UserHelperController::class, 'passwordReset']);
        // balance increment or decrement
        Route::post('balance/add-sub/{user}', [UserHelperController::class, 'userBalanceUpdate']);
        // login info activity
        Route::get('login-activity/{user}', LoginInfo::class);
    });
    // media
    Route::post('image-store', [MediaController::class, 'storeImage']);
    Route::delete('image-delete/{image}', [MediaController::class, 'deleteImage']);

    // incentive bonus
    Route::prefix('incentive/')->group(function () {
        Route::post('search', [InceptiveBonusController::class, 'getCountForInceptiveUser']);
        Route::post('bonus-give', [InceptiveBonusController::class, 'distributeInceptiveBonus']);
        Route::get('bonus', [InceptiveBonusController::class, 'getIncentive']);
    });

    // withdraw confirm
    Route::post('withdraw/confirm', App\Http\Controllers\Staff\V1\WithdrawController::class);

    // dashboard route list
    Route::prefix('dashboard')->group(function (){
        Route::get('/calculation', [App\Http\Controllers\Staff\V1\Dashboard\ReportController::class, 'summationReport']);
    });
    // report
    Route::prefix('report')->group(function () {
        Route::get('bonus', [BonusController::class, 'bonusList']);
        Route::get('withdraw', [WithdrawController::class, 'withdrawList']);
        Route::get('to-earned', [App\Http\Controllers\Staff\V1\Reports\UserController::class, 'topEarned']);
        Route::get('to-sponsor', [App\Http\Controllers\Staff\V1\Reports\UserController::class, 'topSponsor']);
        Route::get('package-purchase', [App\Http\Controllers\Staff\V1\Reports\UserController::class, 'packagePurchaseList']);
        Route::get('charge', [App\Http\Controllers\Staff\V1\Reports\ChargeController::class]);
    });

    // settings
    Route::prefix('settings/')->group(function () {
        Route::get('bonus', [OptionController::class, 'getBonus']);
        Route::get('transfer-charge', [OptionController::class, 'getTransferCharge']);
        Route::get('office-settings', [OptionController::class, 'getOfficeSettings']);
        Route::post('bonus',[OptionController::class, 'storeOption']);
    });
});
