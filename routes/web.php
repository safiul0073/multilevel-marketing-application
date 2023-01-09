<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\Dashboard\HomeController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\HomeCotroller;
use App\Http\Controllers\Frontend\MyTeamController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\NotFoundController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserInfoController;
use App\Http\Controllers\Staff\V1\DashboardController;
use App\Http\Controllers\Staff\V1\UserHelperController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// dashboard page route
Route::get('/staff/{path?}', [DashboardController::class, 'index'])->where('path', '.*');
// end dashboard page route
Route::get('user-login/{user}', [UserHelperController::class, 'userLoginFromDashboard']);
Auth::routes();
Route::get('/', [HomeCotroller::class, 'index'])->name('hello.world.home.page');
Route::get('/products', [ProductController::class, 'index'])->name('product.page');
Route::get('get-one-product-res', [HomeCotroller::class, 'responseProductData'])->name('product.get.one.res');
Route::get('/news', [NewsController::class, 'index'])->name('news.page');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.page');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.page');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.page');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserInfoController::class, 'profile'])->name('user.profile');
        Route::post('/update', [UserInfoController::class, 'update'])->name('user.profile.update');
    });

    Route::prefix('change/password')->group(function () {
        Route::get('/', [UserInfoController::class, 'changePassView'])->name('user.show.change.password');
        Route::post('/', [UserInfoController::class, 'changePassword'])->name('user.change.password');
    });
    Route::get('/dashboard', [HomeController::class, 'index'])->name('user.dashboard');
    Route::get('/user-my-team', [MyTeamController::class, 'userTeamView'])->name('user.my.team');

    Route::get('/user-purchase-product', [HomeController::class, 'productPurchaseView'])->name('user.purchase.product');
    Route::get('/user-deposit', [HomeController::class, 'depositView'])->name('user.deposit');
    Route::get('/user-balance-transfer', [HomeController::class, 'balanceTransferView'])->name('user.balance.transfer');
    Route::get('/user-invoice', [HomeController::class, 'invoiceView'])->name('user.invoice');
});

// registration process
Route::get('set-sponsor', [RegisterController::class, 'setSponsor'])->name('set.sponsor.user');
Route::get('check-sponsor/', [RegisterController::class, 'checkSponsor'])->name('check.sponsor.user');
Route::get('check-user/', [RegisterController::class, 'checkUser'])->name('check.user');
Route::post('save-user', [RegisterController::class, 'saveUser'])->name('save.user');

// not found route
Route::get('not-found', [NotFoundController::class, 'index'])->name('not.found');


