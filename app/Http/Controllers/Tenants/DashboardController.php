<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenant;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Tenants
 */
class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:webmaster|gebruiker']);
    }

    /**
     * Get the dashboard for all the tenants in the application.
     *
     * @param  Tenant      $tenants The database model for the tenants in the portal.
     * @param  null|string $filter  The name of the tenant group u want to display.
     * @return Renderable
     */
    public function index(Tenant $tenants, ?string $filter = null): Renderable
    {
        $tenants = $tenants->getByGroup($filter)->simplePaginate();
        return view('tenants.dashboard', compact('tenants'));
    }

    /**
     * Method for displaying the create view from an tenant.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('tenants.create');
    }
}
