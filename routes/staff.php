<?php

use App\Http\Controllers\API\V1\Staff\Auth\CodeCheckController;
use App\Http\Controllers\API\V1\Staff\Auth\ForgotPasswordController;
use App\Http\Controllers\API\V1\Staff\Auth\ResetPasswordController;
use App\Http\Controllers\API\V1\Staff\Blog\BlogController;
use App\Http\Controllers\API\V1\Staff\Category\CategoryController;
use App\Http\Controllers\API\V1\Staff\Epin\EpinController;
use App\Http\Controllers\API\V1\Staff\Epin\EpinHelperController;
use App\Http\Controllers\API\V1\Staff\DailyIncentive\InceptiveBonusController;
use App\Http\Controllers\API\V1\Staff\LoginInfo;
use App\Http\Controllers\API\V1\Staff\Media\MediaController;
use App\Http\Controllers\API\V1\Staff\Package\PackageController;
use App\Http\Controllers\API\V1\Staff\Package\PackageHelperController;
use App\Http\Controllers\API\V1\Staff\PaymentMethod\PaymentMethodController;
use App\Http\Controllers\API\V1\Staff\User\UserController;
use App\Http\Controllers\API\V1\Staff\Settings\OptionController;
use App\Http\Controllers\API\V1\Staff\Slider\SliderController;
use App\Http\Controllers\API\V1\Staff\User\UserHelperController;
use App\Http\Controllers\API\V1\Staff\Auth\StaffController;
use App\Http\Controllers\API\V1\Staff\Contact\ContactController;
use App\Http\Controllers\API\V1\Staff\Faq\FaqController;
use App\Http\Controllers\API\V1\Staff\Reports\BonusController;
use App\Http\Controllers\API\V1\Staff\Reports\WithdrawController;
use App\Http\Controllers\API\V1\Staff\Reward\RewardController;
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
    Route::apiResources([
        'category'       => CategoryController::class,
        'payment-method' => PaymentMethodController::class,
        'package'        => PackageController::class,
        'slider'         => SliderController::class,
        'epin'           => EpinController::class,
        'reward'         => RewardController::class,
        'blog'           => BlogController::class,
        'faq'            => FaqController::class,
        'contact'        => ContactController::class,
    ]);
    // resource route end

    // epin helper
    Route::post('store-epin', [EpinHelperController::class, 'storeEpin']);
    Route::delete('delete-epin/{id}', [EpinHelperController::class, 'deleteEpin']);
    // package helper
    Route::get('package-list', [EpinHelperController::class, 'getProductList']);
    Route::get('all-package', [PackageHelperController::class, 'getAllPackage']);
    Route::get('package-images/{product}', [PackageHelperController::class, 'getProductImages']);

    // category and slider helper
    Route::get('category-list', [PackageHelperController::class, 'getCategoryList']);

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
    Route::post('withdraw/confirm', App\Http\Controllers\API\V1\Staff\WithdrawController::class);

    // dashboard route list
    Route::prefix('dashboard')->group(function (){
        Route::get('/calculation', [App\Http\Controllers\API\V1\Staff\Dashboard\ReportController::class, 'summationReport']);
    });
    // report
    Route::prefix('report')->group(function () {
        Route::get('bonus', [BonusController::class, 'bonusList']);
        Route::get('withdraw', [WithdrawController::class, 'withdrawList']);
        Route::get('daily-incentive', [InceptiveBonusController::class, 'dailyBonusReport']);
        Route::get('charges', App\Http\Controllers\API\V1\Staff\Reports\ChargeController::class);
        Route::get('rewards', App\Http\Controllers\API\V1\Staff\Reports\RewardController::class);
        Route::get('transactions', App\Http\Controllers\API\V1\Staff\Reports\TransactionController::class);
        Route::get('to-earned', [App\Http\Controllers\API\V1\Staff\Reports\UserController::class, 'topEarned']);
        Route::get('to-sponsor', [App\Http\Controllers\API\V1\Staff\Reports\UserController::class, 'topSponsor']);
        Route::get('package-purchase', [App\Http\Controllers\API\V1\Staff\Reports\PurchaseController::class, 'packagePurchaseList']);
    });

    // settings
    Route::prefix('settings/')->group(function () {
        Route::get('bonus', [OptionController::class, 'getBonus']);
        Route::get('transfer-charge', [OptionController::class, 'getTransferCharge']);
        Route::get('office', [OptionController::class, 'getOfficeSettings']);
        Route::get('home', [OptionController::class, 'getHomeContent']);
        Route::post('options',[OptionController::class, 'storeOption']);
        Route::get('option', [OptionController::class, 'getOptionValue']);
        Route::get('option-image', [OptionController::class, 'getMediaImage']);
    });
});
