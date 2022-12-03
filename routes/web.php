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
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\HomeCotroller;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Staff\DashboardController;
use Illuminate\Support\Facades\Route;

// dashboard page route
Route::get('/staff/{slag?}', [DashboardController::class, 'index']);
// end dashboard page route

Route::get('/', [HomeCotroller::class, 'index'])->name('home')->name('index.home.page');
Route::get('/products', [ProductController::class, 'index'])->name('product.page');
Route::get('/news', [NewsController::class, 'index'])->name('news.page');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.page');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.page');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.page');
