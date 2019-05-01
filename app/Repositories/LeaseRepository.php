<?php 

namespace App\Repositories;

use App\Models\Tenant;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Lease;
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
     * Method for getting the leases by filter group.
     *
     * @param  string|null $filter The name of the filter that u want to apply.
     * @return Builder
     */
    public function getByGroup(?string $filter = null): Builder
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

        if ($lease = $this->create($request->all())) {
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