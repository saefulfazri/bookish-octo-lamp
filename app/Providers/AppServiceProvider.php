<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Configuration;
use App\Http\Controllers\RekapAbsensiController;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    
    }
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }


}
