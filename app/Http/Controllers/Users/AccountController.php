<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\InformationValidator;
use App\Http\Requests\Users\SecurityValidator;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

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
        $this->middleware(['auth', 'forbid-banned-user']);
    }

    /**
     * Method for displaying the account information settings
     *
     * @return Renderable
     */
    public function showInformation(User $user): Renderable
    {
        $ban = $user->bans()->latest()->first();
        return view('account.information', compact('user', 'ban'));
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
     * Method for updating the account information.
     *
     * @todo Fill in the validator class.
     * @todo Complete docblock class
     *
     * @param  InformationValidator $input
     * @return RedirectResponse
     */
    public function updateInformation(InformationValidator $input): RedirectResponse
    {
        $user = auth()->user();
        $input->merge(['name' => "{$input->firstname} {$input->lastname}"]);

        if ($user->update($input->all())) {
            $user->flashSuccess('Uw hebt uw account informatie met succes aangepast.');
        }

        return redirect()->route('users.account.info', $user);
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
        } else { // Could not secure the request. So we abort the security update process.
            $user->flashDanger('Uw huidige wachtwoord komt niet overeen met het gegeven wachtwoord.');
        }

        return redirect()->route('users.account.security');
    }
}
