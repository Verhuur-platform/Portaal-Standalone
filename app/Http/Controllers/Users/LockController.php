<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Http\Requests\Users\LockValidator;

/**
 * Class LockController
 * 
 * @package App\Http\Controllers\Users
 */
class LockController extends Controller
{
    /**
     * Create new LockController instance. 
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:gebruiker|webmaster'])->except(['index']);
    }

    /**
     * Method for displaying the error page when an user is deactivated in the portal. 
     * 
     * @return Renderable
     */
    public function index(): Renderable
    {
        $user = Auth::user();

        if ($user->isBanned()) { 
            $banInfo = $user->bans()->latest()->first();
            return view('errors.locked-account', compact('banInfo'));
        }

        // We can't find the lock on the login so there is no page to be displayed.
        // So throw an HTTP - 404 Not Found to the user
        return abort(Response::HTTP_NOT_FOUND);
    }

    /**
     * Method for displaying the create view for the login lock. 
     * 
     * @param  User $userEntity The storage entity from the user who needs to recieve the lock.
     * @return Renderable
     */
    public function create(User $userEntity): Renderable
    {
        $this->authorize('create-lock', $userEntity); 
        return view('users.lock', compact('userEntity'));
    }

    /**
     * Method for storing the user lock in the application (portal).
     * 
     * @param  LockValidator $input The form request class that handles the validation.
     * @param  User          $user  The database storage entity from the given user.
     * @return RedirectResponse
     */
    public function store(LockValidator $input, User $userEntity): RedirectResponse
    {
        $this->authorize('create-lock', $userEntity); 
        $authUser = Auth::user();

        if ($authUser->isRequestSecured($input->confirmatie) && $userEntity->ban(['comment' => $input->reden])) {
            $authUser->logActivity('Logins', "Heeft de login van {$userEntity->name} gedeactiveerd in het systeem.");

            return redirect()->route('users.show', $userEntity);
        } 

        // The request could not be secured so redirect the user back to the lock create view
        // And display him an validation error 
        return redirect()->route('users.lock', $userEntity)
            ->withErrors(['confirmatie' => 'Het gegeven wachtwoord klopt niet met uw huidige wachtwoord.']);
    }

    /**
     * Method for remove a user lock in the application.
     * 
     * @param  User $userEntity The database storage entity from the given user.
     * @return RedirectResponse
     */
    public function destroy(User $userEntity): RedirectResponse
    {
        $this->authorize('remove-lock', $userEntity);

        $userEntity->removeLock();
        return redirect()->route('users.index');
    }
}
