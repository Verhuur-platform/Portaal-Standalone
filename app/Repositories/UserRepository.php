<?php

namespace App\Repositories; 

use App\User;
use App\Traits\SecuredRequest;
use App\Traits\FlashMessenger; 
use App\Interfaces\FlashMessengerInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository 
 * 
 * @package App\Repositories
 */
class UserRepository extends Authenticatable implements FlashMessengerInterface
{
    use SecuredRequest, FlashMessenger;

    /**
     * Method for hashing the given password in the application storage.
     *
     * @param  string $password The given or generated password from the application/form.
     * @return void
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Method for tracking if the given user is online or not. 
     * 
     * @return bool
     */
    public function isOnline(): bool 
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    /**
     * Method for determining if the authenticated user can access the deleted user overview or not. 
     * 
     * @return bool 
     */
    public function cantAccessDeletedOverview(): bool 
    {
        return ! $this->hasRole('webmaster') && url()->current() === url('/logins/verwijderd');
    }

    /**
     * Method for getting application logins by filter criteria. 
     * --- 
     * Fallback = all users when the user is not permitted to the criteria. 
     * 
     * @param   string|null $filter   The name of the filter criteria that should be applied. 
     * @return  Builder
     */
    public function getUsersByRequest(?string $filter = null): Builder
    {
        $query = User::query();

        $query->when($filter === 'actief', function (Builder $builder) {
            return $builder->withoutBanned();
        });

        $query->when($filter === 'gedeactiveerd', function (Builder $builder) {
            return $builder->onlyBanned();
        });

        $query->when($filter === 'verwijderd' && auth()->user()->hasRole('webmaster'), function (Builder $builder) {
            return $builder->onlyTrashed();
        });

        return $query; // No matching filter is found. So return a builder instance without any scopes on it.
    }

    /**
     * Method for deleting an user in the application.
     *
     * @throws \Exception
     *
     * @param  Request $request  The request information collection instance
     * @return void
     */
    public function deleteLogin(Request $request): void 
    {
        if ($this->isRequestSecured($request->confirmatie) && $this->delete()) {
            if (auth()->user()->cannot('same-user', $this)) {
                $this->logActivity('Logins', "heeft de gebruiker {$this->name} verwijderd in het portaal.");
            } 

            $this->flashSuccess("De login van {$this->name} is verwijderd in het portaal.");
        } 

        // The user is not deleted in the application so return an error as flash message. 
        else {
            $this->flashWarning("De login van {$this->name} kon niet worden verwijderd in de applicatie.");
        }
    }

    /**
     * Method for deleting the user lock in the application. 
     * 
     * @return void
     */
    public function removeLock(): void 
    {
        $this->unban();
        $this->logActivity('Logins', "heeft de login van {$this->name} terug geactiveerd in het portaal.");
        $this->flashInfo("De login van {$this->name} is terug actief in het systeem.");
    }
}