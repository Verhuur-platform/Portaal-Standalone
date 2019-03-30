<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Requests\Lease\TenantsValidator;
use App\Models\Tenant;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
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

    /**
     * Method for storing an new tenant in the application.
     *
     * @param  TenantsValidator $input The form request class that handles the validation.
     * @param  Tenant           $model The database model class for the tenants storage.
     * @return RedirectResponse
     */
    public function store(TenantsValidator $input, Tenant $model): RedirectResponse
    {
        $input->merge(['full_name' => "{$input->firstname} {$input->lastname}"]);

        if (! $model->createTenant($input->all())) {
            $model->flashDanger('Er is iets misgelopen tijdens het opslaan van de huurder.');
        }

        return redirect()->route('tenants.dashboard');
    }
}
