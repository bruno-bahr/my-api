<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use app\Services\AccountService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AccountService::class, function ($app) {
            return new AccountService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
