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
        $this->middleware(['auth']);
    }

    /**
     * Method for displaying the dashboard for the application logins. 
     *
     * @param  User         $users
     * @param  null|string  $filter
     * @return Renderable
     */
    public function index(User $users, ?string $filter = null): Renderable
    {
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
            $viewPath = (Gate::allows('same-user', $user)) ? 'users.settings.delete' : 'users.delete';
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
