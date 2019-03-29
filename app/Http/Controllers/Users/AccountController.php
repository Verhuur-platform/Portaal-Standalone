<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Users\SecurityValidator;

/**
 * Class AccountController
 * 
 * @package App\Http\Controllers\Users
 */
class AccountController extends Controller
{
    /**
     * Create new AccountController instance 
     * 
     * @return void
     */
    public function __construct() 
    {
        $this->middleware(['auth']);
    }

    /**
     * Method for displaying the account security settings. 
     * 
     * @return Renderable 
     */
    public function showSecurity(): Renderable
    {
        return view('account.security', ['user' => auth()->user()]);
    }

    /**
     * Method for upating the authenticated user his security settings. 
     * 
     * @param  SecurityValidator $input The form request class that handles the form validation. 
     * @return RedirectResponse
     */
    public function updateSecurity(SecurityValidator $input): RedirectResponse
    {
        $user = auth()->user();

        if ($user->isRequestSecured($input->huidig_wachtwoord) && $user->update(['password' => $input->wachtwoord])) {
            $user->flashInfo('Uw beveiligings instellingen zijn met success aangepast.');
            auth()->logoutOtherDevices($input->wachtwoord);
        } 
        
        else { // Could not secure the request. So we abort the security update process. 
            $user->flashDanger('Uw huidige wachtwoord komt niet overeen met het gegeven wachtwoord.');
        }

        return redirect()->route('users.account.security');
    }
}
