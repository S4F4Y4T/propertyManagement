<?php

use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\Api\OwnerController;
use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::apiResource('tenants', TenantController::class);    
    Route::apiResource('house-owners', OwnerController::class);
});

