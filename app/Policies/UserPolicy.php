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

    public function createLock(User $user, User $model): bool 
    {
        return ! $this->sameUser($user, $model) && $model->isNotBanned();
    }
}
