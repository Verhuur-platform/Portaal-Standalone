<?php

namespace App\Policies;

use App\User;
use App\Models\Lease;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class LeasePolicy 
 * 
 * @package App\Policies
 */
class LeasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the lease.
     *
     * @param  User   $user  The resource entity from the authenticated user. 
     * @param  Lease  $lease The resource entity from the given lease.
     * @return bool
     */
    public function update(User $user, Lease $lease): bool
    {
        return $user->is($lease->successor) || $user->hasRole('webmaster');
    }
}
