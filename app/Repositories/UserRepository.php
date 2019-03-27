<?php

namespace App\Repositories; 

use App\Traits\SecuredRequest;
use App\Traits\FlashMessenger; 
use App\Interfaces\FlashMessengerInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

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
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Method for deleting an user in the application. 
     * 
     * @param  Request $request The request information collection 
     * @return void
     */
    public function deleteLogin(Request $request): void 
    {
        if ($this->isRequestSecured($request->confirmatie) && $this->delete()) {
            $this->logActivity('Logins', "heeft de gebruiker {$this->name} verwijderd in het portaal.");

            $undoLink = '<a href="'. route('users.delete.undo', $this) .'" class="ml-2 text-decoration-none">Ongedaan maken</a>'; 
            $this->flashSuccess("De login van {$this->name} is verwijderd in het portaal. {$undoLink}")->important();
        } 

        // The user is not deleted in the application se return an error as flash message. 
        else {
            $this->flashWarning("De login van {$this->name} kon niet worden verwijderd in de applicatie.");
        }
    }
}