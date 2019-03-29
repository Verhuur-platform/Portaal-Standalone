<?php

namespace App\Providers;

use App\User;
use App\Observers\UserObserver;
use App\Composers\AccountComposer;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider 
 * 
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // View Composers 
        view()->composer('*', AccountComposer::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
