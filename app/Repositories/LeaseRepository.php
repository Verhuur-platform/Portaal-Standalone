<?php

namespace App\Repositories;

use App\Models\Lease;
use App\Models\Scopes\LeaseScopes;
use App\Models\Tenant;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class LeaseRepository
 *
 * @package App\Repositories
 */
class LeaseRepository extends Model
{
    /**
     * Method to register the builder instance with all the query scopes.
     *
     * @param \Illuminate\Database\Query\Builder $builder Database query builder instance
     * @return LeaseScopes
     */
    public function newEloquentBuilder($builder): LeaseScopes
    {
        return new LeaseScopes($builder);
    }

    /**
     * Method for getting the new lease requests that are displaying on the dashboard.
     *
     * @return mixed
     */
    public function dashboardResults()
    {
        return $this->whereHas('status', function ($query) {
            $query->where('name', 'nieuwe aanvraag');
        })->upcoming()->take(5)->get();
    }

    /**
     * Method for getting the leases by filter group.
     *
     * @param  string|null $filter The name of the filter that u want to apply.
     * @return LeaseScopes
     */
    public function getByGroup(?string $filter = null): LeaseScopes
    {
        $leases = Lease::query();
        return $leases; // No matching filter is found. So return a builder instance without any scopes on it
    }

    /**
     * Method for storing an new lease in the application.
     *
     * @param  Tenant    $tenant     The resource entity form the created or find tenant.
     * @param  Request   $request    The request instance that holds all the information.
     * @return Lease
     */
    public function storeLease(Tenant $tenant, Request $request): Lease
    {
        $request->merge(['status_id' => $request->status, 'tenant_id' => $tenant->id]);
        $lease = $this->create($request->all());

        if ($lease) {
            $successor = $this->getSuccessor($request->follower_id);
            $lease->successor()->associate($successor)->save();

            auth()->user()->logActivity('Verhuringen', 'Heeft een verhuring toegevoegd in de applicatie.');
        }

        return $lease;
    }

    /**
     * Method for registering the successor who doing the follow up from the lease;
     *
     * @param  int|null $successor The unique resource id from the application user.
     * @return User
     */
    private function getSuccessor(?int $successor = null): User
    {
        if (auth()->user()->id === $successor || empty($successor)) {
            return auth()->user();
        }

        return User::find($successor);
    }
}
