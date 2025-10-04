<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Bill;
use App\Observers\BillObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Bill::observe(BillObserver::class);
    }
}
