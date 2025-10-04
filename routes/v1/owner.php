<?php

use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\Api\FlatController;
use App\Http\Controllers\Api\OwnerController;
use App\Http\Controllers\Api\BillCategoryController;
use App\Http\Controllers\Api\BillController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'owner', 'middleware' => ['auth', 'owner']], function () {

    Route::get('dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');

    Route::apiResource('flats', FlatController::class);
    Route::apiResource('bill-categories', BillCategoryController::class);

    Route::get('tenants', [TenantController::class, 'index'])->name('owner.tenants.index');

    Route::prefix('flats/{flat}')->group(function () {
        Route::post('bills', [BillController::class, 'store'])->name('flats.bills.store');
    });

    Route::apiResource('bills', BillController::class)->only(['index', 'show', 'destroy']);
    Route::patch('bills/{bill}/pay', [BillController::class, 'pay'])->name('bills.pay');
});