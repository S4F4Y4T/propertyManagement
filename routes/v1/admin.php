<?php

use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\Api\OwnerController;
use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::apiResource('tenants', TenantController::class); 
    Route::get('house-owners/{house_owner}/flats', [OwnerController::class,'flats'])->name('owners.flats');
    Route::apiResource('house-owners', OwnerController::class);
});

