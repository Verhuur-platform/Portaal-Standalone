<?php

namespace App\Http\Controllers\Lease;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Models\Lease;

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
     * @param  Lease        $leases The database model instance for the leases. 
     * @param  null|string  $filter The filter name that needs to be applied. Defaults to null.
     * @return Renderable
     */
    public function index(Lease $leases, ?string $filter = null): Renderable
    {
        $leases = $leases->getByGroup($filter)->simplePaginate();
        return view('lease.dashboard', compact('leases'));
    }
}
