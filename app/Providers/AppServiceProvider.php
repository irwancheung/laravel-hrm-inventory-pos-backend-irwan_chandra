<?php

namespace App\Providers;

use App\Services\HttpResponseService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // register HttpResponseService.php as singleton
        $this->app->singleton(HttpResponseService::class, function ($app) {
            return new HttpResponseService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
