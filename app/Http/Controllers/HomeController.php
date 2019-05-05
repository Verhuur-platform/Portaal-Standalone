<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Tenant;
use App\User;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->only('indexFrontend');
        $this->middleware(['auth', 'forbid-banned-user'])->only(['indexBackend']);
    }

    /**
     * Display the welcome page of the application.
     *
     * @return Renderable
     */
    public function indexFrontend(): Renderable
    {
        return view('auth.login');
    }

    /**
     * Show the application dashboard.
     *
     * @param  User     $users    The database model class for the users.
     * @param  Tenant   $tenants  The database model class for the tenants.
     * @param  Lease    $leases   The database model class for the leases.
     * @return Renderable
     */
    public function indexBackend(User $users, Tenant $tenants, Lease $leases): Renderable
    {
        // TODO Format counters to view composer.
        $counters = [
            'leases'  => ['all' => $leases->count()], //! TODO implement new lease counter.
            'users'   => ['all' => $users->count(), 'deactivated' => $users->onlyBanned()->count()],
            'tenants' => ['all' => $tenants->count(), 'today' => $tenants->whereDate('created_at', now())->count()],
        ];

        $newLeases = $leases->dashboardResults();

        return view('home', compact('counters', 'newLeases'));
    }
}
