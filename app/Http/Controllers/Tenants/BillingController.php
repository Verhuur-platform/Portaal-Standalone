<?php

namespace App\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Models\Tenant;

/**
 * Class BillingController
 * 
 * @package App\Http\Controllers\Tenants
 */
class BillingController extends Controller
{
    /**
     * DashboardController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:webmaster']);
    }

    /**
     * 
     */
    public function show(Tenant $tenant): Renderable
    {
        $billingInfo = $tenant->billingInfo;
        return view('tenants.billing.show', compact('tenant', 'billingInfo'));
    }
}
