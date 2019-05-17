<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\LoginValidator;
use App\User;
use Gate;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Mpociot\Reanimate\ReanimateModels;
use Spatie\Permission\Models\Role;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Users
 */
class DashboardController extends Controller
{
    use ReanimateModels;

    /**
     * Create new DashboardController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authUser = Auth::user();
        $this->middleware(['auth', 'forbid-banned-user', 'role:gebruiker|webmaster']);
        $this->middleware(['role:webmaster'])->only(['undoDeleteRoute']);
    }

    /**
     * Method for displaying the dashboard for the application logins.
     *
     * @param  User         $users  The database model entity from the users storage.
     * @param  string|null  $filter The filter name that needs to be applied. Defaults to null.
     * @return Renderable
     */
    public function index(User $users, ?string $filter = null): Renderable
    {
        abort_if(Auth::user()->cantAccessDeletedOverview(), Response::HTTP_FORBIDDEN);

        $users = $users->getUsersByRequest($filter);
        return view('users.dashboard', ['users' => $users->simplePaginate()]);
    }

    /**
     * Method for displaying the create view for a new user.
     *
     * @param  Role $roles The database model for all the ACL roles in the application.
     * @return Renderable
     */
    public function create(Role $roles): Renderable
    {
        $roles = $roles->get(['name']);
        return view('users.create', compact('roles'));
    }

    /**
     * Method for storing the new user in the application.
     *
     * @see \App\Observers\UserObserver::created() <- Register password and notifify the user.
     *
     * @param  LoginValidator $input    The form request class that handles the validation.
     * @param  User           $user     The model class for the logins in the application.
     * @return RedirectResponse
     */
    public function store(LoginValidator $input, User $user): RedirectResponse
    {
        // Activity log happends on the UserObserver action.
        $input->merge(['name' => "{$input->firstname} {$input->lastname}"]);
        $user = $user->create($input->all());

        if ($user) {
            $user->assignRole($input->role);
            $user->flashSuccess("Er is een login aangemaakt voor <strong>{$user->name}</strong>");
        }

        return redirect()->route('users.index');
    }

    /**
     * Method for deleting an user account in the application.
     *
     * @param  Request  $request    The request information collection
     * @param  User     $user       The storage entity from the given user.
     * @return Renderable|RedirectResponse
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->isMethod('GET')) {
            $viewPath = Gate::allows('same-user', $user) ? 'account.delete' : 'users.delete';
            return view($viewPath, compact('user'));
        }

        // Method is an delete action so move on with the logic
        $request->validate($user->securedRequestRules());
        $user->deleteLogin($request);
        
        return redirect()->route('users.index');
    }

    /**
     * Method for undo the delete form the user account in the application.
     *
     * @param  User $trashedUser The resource entity from the soft deleted user in the application.
     * @return RedirectResponse
     */
    public function undoDeleteRoute(User $trashedUser): RedirectResponse
    {
        Auth::user()->logActivity('Logins', "heeft de verwijdering van {$trashedUser->name} ongedaan gemaakt in het portaal.");
        $trashedUser->flashInfo("De verwijdering van {$trashedUser->name} is ongedaan gemaakt in het portaal.");
        
        return $this->restoreModel($trashedUser->id, new User(), 'users.index');
    }
}
