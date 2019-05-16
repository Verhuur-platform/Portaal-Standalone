<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy 
 * 
 * @package App\Policies
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user  The resource entity from the authenticated user.
     * @param  User  $model The resource entity from the given model.
     * @return bool
     */
    public function sameUser(User $user, User $model): bool
    {
        return $user->is($model);
    }

    /**
     * Determine whether the auth user can create a user lock or not. 
     * 
     * @param  User  $user  The resource entity from the authenticated user.
     * @param  User  $model The resource entity from the given model.
     * @return bool
     */
    public function createLock(User $user, User $model): bool 
    {
        return ! $this->sameUser($user, $model) && $model->isNotBanned() && $user->hasRole('webmaster');
    }

    /**
     * Determine whether the auth user can remove the user lock or not. 
     * 
     * @param  User  $user  The resource entity from the authenticated user.
     * @param  User  $model The resource entity from the given model.
     * @return bool
     */
    public function removeLock(User $user, User $model): bool 
    {
        return ! $this->sameUser($user, $model) && $user->hasRole('webmaster') && $model->isBanned();
    }
}
