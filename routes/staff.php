<?php

use App\Http\Controllers\Staff\StaffController;
use Illuminate\Support\Facades\Route;

// api route start for dashboard
// auth route start ...
Route::post('/login', [StaffController::class, 'login'])->name('login');
Route::middleware('auth:staff')->group(function () {
    Route::get('/me', [StaffController::class, 'me'])->name('me');
});
