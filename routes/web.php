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

use App\Http\Controllers\Frontend\HomeCotroller;
use App\Http\Controllers\Staff\DashboardController;
use Illuminate\Support\Facades\Route;

// dashboard page route
Route::get('/staff/{slag?}', [DashboardController::class, 'index']);
// end dashboard page route

Route::get('/', [HomeCotroller::class, 'index'])->name('home');
// Route::get('/product',)
