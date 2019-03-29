<?php

namespace App\Http\Controllers\Users;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\User;
use Mpociot\Reanimate\ReanimateModels;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

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
        $this->middleware(['auth', 'role:gebruiker|webmaster']);
        $this->middleware(['role:webmaster'])->only(['undoDeleteRoute']);
    }

    /**
     * Method for displaying the dashboard for the application logins. 
     *
     * @param  User         $users  The database model entity from the users storage.
     * @param  null|string  $filter The filter name that needs to be applied. Defaults to null.
     * @return Renderable
     */
    public function index(User $users, ?string $filter = null): Renderable
    {
        abort_if(Auth::user()->cantAccessDeletedOverview(), Response::HTTP_FORBIDDEN);

        $users = $users->getUsersByRequest($filter);
        return view('users.dashboard', ['users' => $users->simplePaginate()]);
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
            $viewPath = (Gate::allows('same-user', $user)) ? 'account.delete' : 'users.delete';
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
