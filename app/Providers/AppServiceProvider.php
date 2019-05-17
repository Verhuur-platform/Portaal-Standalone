<?php

namespace App\Providers;

use App\Composers\AccountComposer;
use App\Models\Note;
use App\Observers\NoteObserver;
use App\Observers\UserObserver;
use App\User;
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
        // Model Observers
        User::observe(UserObserver::class);
        Note::observe(NoteObserver::class);
    }
}
