<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

/**
 * Class LockController
 * 
 * @package App\Http\Controllers\Users
 */
class LockController extends Controller
{
    /**
     * The Guard implementation.
     *
     * @var Guard $auth
     */
    protected $auth;

    /**
     * Create new LockController instance. 
     * 
     * @param  Guard $auth The authentication guard variable.
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

    public function store(): RedirectResponse
    {

    }

    public function delete(User $user): RedirectResponse
    {

    }
}
