<?php

namespace App\Providers;

use App\Models\Lease;
use App\Models\Note;
use App\Policies\LeasePolicy;
use App\Policies\NotePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Note::class  => NotePolicy::class,
        Lease::class => LeasePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
