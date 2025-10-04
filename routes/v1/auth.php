<?php

use App\Http\Controllers\Api\AuthenticationController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth'], function () {
    Route::middleware(['public'])->group(function () {
        Route::post('login', [AuthenticationController::class, 'login'])->name('auth.login');
    });

    Route::middleware(['auth'])->group(function () {
        Route::post('logout', [AuthenticationController::class, 'logout'])->name('auth.logout');
        Route::get('me', [AuthenticationController::class, 'me'])->name('auth.me');
    });
});

