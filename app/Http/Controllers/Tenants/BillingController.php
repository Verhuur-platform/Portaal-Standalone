<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request; 
use Illuminate\Http\RedirectResponse;

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
     * Method for displaying the billing information from the tenant.
     *
     * @param  Tenant $tenant The resource entity from the tenant in the application.
     * @return Renderable
     */
    public function show(Tenant $tenant): Renderable
    {
        $billingInfo = $tenant->billingInfo;
        return view('tenants.billing', compact('tenant', 'billingInfo'));
    }

    /**
     * Method for storing/updating the billing information from the tenant. 
     * 
     * @param  Request  $input  The form request class that holds all the form inputs. 
     * @param  Tenant   $tenant The resource entity from the given tenant in the storage.
     * @return RedirectResponse
     */
    public function update(Request $input, Tenant $tenant): RedirectResponse
    {
        // No validation has been added. Because the billing information is not needed 
        // In some cases because the tenant can pay his lease cash in some cases. 

        if ($tenant->billingInfo()->updateOrCreate(['tenant_id' => $tenant->id], $input->all())) {
            auth()->user()->logActivity('Facturatie', "Heeft de facturatie informatie van {$tenant->full_name} aangepast.");
            auth()->user()->flashSuccess("De facturatie data van {$tenant->full_name} is aangepast!");
        }

        return redirect()->route('tenant.billing', $tenant);
    }
}
