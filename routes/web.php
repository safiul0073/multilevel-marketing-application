<?php

use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\BalanceTransferController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\Dashboard\HomeController;
use App\Http\Controllers\Frontend\Dashboard\ReferralController;
use App\Http\Controllers\Frontend\Dashboard\RewardController;
use App\Http\Controllers\Frontend\DisclaimerPolicyController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\HomeController as HomePageController;
use App\Http\Controllers\Frontend\IncentiveBonusController;
use App\Http\Controllers\Frontend\MyTeamController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\NotFoundController;
use App\Http\Controllers\Frontend\PrivacyPolicyController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\SpamPolicyController;
use App\Http\Controllers\Frontend\TramsAndConditionController;
use App\Http\Controllers\Frontend\UserInfoController;
use App\Http\Controllers\Frontend\WithdrawController;
use App\Http\Controllers\API\V1\Staff\DashboardController;
use App\Http\Controllers\API\V1\Frontend\LoginFromDashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// dashboard page route
Route::get('/staff/{path?}', [DashboardController::class, 'index'])->where('path', '.*');
// end dashboard page route
Route::get('user-login/{user}', LoginFromDashboard::class);
Auth::routes();
Route::get('/', [HomePageController::class, 'index'])->name('hello.world.home.page');
Route::get('/packages', [ProductController::class, 'index'])->name('package.page');
Route::get('/products', [ProductController::class, 'index'])->name('product.page');
Route::get('get-one-product-res', [HomePageController::class, 'responseProductData'])->name('product.get.one.res');
Route::get('/news', [NewsController::class, 'index'])->name('news.page');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('new.show');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.page');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.page');
Route::resource('contact', ContactController::class)->only(['index', 'store']);
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.page');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserInfoController::class, 'profile'])->name('user.profile');
        Route::post('/update', [UserInfoController::class, 'update'])->name('user.profile.update');
        Route::post('avatar-upload', [UserInfoController::class, 'avatarUpload'])->name('profile.avatar.upload');
    });

    Route::prefix('change/password')->group(function () {
        Route::get('/', [UserInfoController::class, 'changePassView'])->name('user.show.change.password');
        Route::post('/', [UserInfoController::class, 'changePassword'])->name('user.update.password');
    });

    Route::prefix('incentive')->name('incentive.')->group(function () {
        Route::get('view', [IncentiveBonusController::class, 'index'])->name('view');
        Route::post('add-bonus', [IncentiveBonusController::class, 'addToWallet'])->name('add.bonus');
    });

    Route::prefix('withdraw')->name('withdraw.')->group(function () {
        Route::get('/request', [WithdrawController::class, 'index'])->name('request');
        Route::post('/balance', [WithdrawController::class, 'withdrawBalance'])->name('balance');
        Route::get('/list', [WithdrawController::class, 'withdrawList'])->name('list');
    });

    // user balance transfer
    Route::prefix('transfer')->name('transfer.')->group(function () {
        Route::get('page', [BalanceTransferController::class, 'index'])->name('page');
        Route::post('send', [BalanceTransferController::class, 'transferBalance'])->name('balance');
    });

    Route::prefix('my-team')->name('my.team.')->group(function () {
        Route::get('/view', [MyTeamController::class, 'userTeamView'])->name('view');
        Route::get('modal-view/{user}', [MyTeamController::class, 'getModelData'])->name('modal');
    });

    Route::get('/dashboard', [HomeController::class, 'index'])->name('user.dashboard');
    Route::get('reward-show', [RewardController::class, 'index'])->name('dashboard.reward.show');
    Route::get('/user-referrals', [ReferralController::class, 'index'])->name('user.referral.list.view');
    Route::get('/user-purchase-product', [HomeController::class, 'productPurchaseView'])->name('user.purchase.product');
    Route::get('/user-deposit', [HomeController::class, 'depositView'])->name('user.deposit');
    Route::get('/user-balance-transfer', [HomeController::class, 'balanceTransferView'])->name('user.balance.transfer');
    Route::get('/user-invoice', [HomeController::class, 'invoiceView'])->name('user.invoice');
    Route::get('/dashboard/bonuses', [App\Http\Controllers\Frontend\Dashboard\BonusController::class, 'index'])->name('dashboard.bonuses');
});

Route::get('trams-condition', [TramsAndConditionController::class, 'index'])->name('trams.condition');
Route::get('spam-policy', [SpamPolicyController::class, 'index'])->name('spam.policy');
Route::get('privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy.policy');
Route::get('disclaimer-policy', [DisclaimerPolicyController::class, 'index'])->name('disclaimer.policy');
// registration process
Route::get('set-sponsor', [RegisterController::class, 'setSponsor'])->name('set.sponsor.user');
Route::get('check-sponsor/', [RegisterController::class, 'checkSponsor'])->name('check.sponsor.user');
Route::get('check-user/', [RegisterController::class, 'checkUser'])->name('check.user');
Route::post('save-user', [RegisterController::class, 'saveUser'])->name('save.user');

// not found route
Route::get('not-found', [NotFoundController::class, 'index'])->name('not.found');
