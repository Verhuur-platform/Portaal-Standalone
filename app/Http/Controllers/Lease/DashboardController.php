<?php

namespace App\Http\Controllers\Lease;

use App\Notifications\LeaseAssigned;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Models\Lease;
use App\User;
use App\Models\Status;
use App\Http\Requests\Lease\LeaseValidator;
use App\Models\Tenant;

/**
 * Class DashboardController
 * 
 * @package App\Http\Controllers\Lease
 */
class DashboardController extends Controller
{
    /**
     * Create new Dashboard controller instance. 
     * 
     * @return void
     */
    public function __construct() 
    {
        $this->middleware(['auth', 'forbid-banned-user']);
    }

    /**
     * Method for displaying the lease dashboard. 
     * 
     * @todo Implement search function 
     * @todo Implement the request filters on the view and backend.
     * 
     * @param  Lease        $leases The database model instance for the leases. 
     * @param  null|string  $filter The filter name that needs to be applied. Defaults to null.
     * @return Renderable
     */
    public function index(Lease $leases, ?string $filter = null): Renderable
    {
        $leases = $leases->getByGroup($filter)->simplePaginate();
        return view('lease.dashboard', compact('leases'));
    }

    /**
     * Method for displaying the lease create view.
     *
     * @param  User $users The database model class for the application users.
     * @return Renderable 
     */
    public function create(User $users): Renderable 
    {
        $users     = $users->get(['id', 'name']);
        $statusses = Status::all();

        return view('lease.create', compact('users', 'statusses'));
    }

    /**
     * Method for displaying the lease information in the application. 
     * 
     * @param  Lease $lease The resource entity from the lease in the application. 
     * @return Renderable 
     */
    public function show(Lease $lease): Renderable
    {
        $cantEdit = $this->getAuthenticatedUser()->cannot('update', $lease);
        $statuses = Status::all()->pluck('name', 'id');

        return view('lease.show', compact('lease', 'cantEdit', 'statuses'));
    }

    /**
     * Method for storing an new lease in the application. 
     * 
     * @param  LeaseValidator $input    The form request instance that holds all the request information.
     * @param  Tenant         $tenant   The database model class for the tenants in the application. 
     * @param  Lease          $lease    The database model class for the leases in the application. 
     * @return RedirectResponse 
     */
    public function store(LeaseValidator $input, Tenant $tenant, Lease $lease): RedirectResponse 
    {
        $tenant     = $tenant->getOrCreate($input);
        $lease      = $lease->storeLease($tenant, $input);

        if ($lease && $tenant) { // lease is created and tenant is found or created. 
            if (! $this->getAuthenticatedUser()->is($lease->successor)) {
                $when = now()->addMinute();
                $lease->successor->notify((new LeaseAssigned($lease, $this->getAuthenticatedUser()))->delay($when));
            }
        }

        return redirect()->route('lease.show', $lease);
    }
}
