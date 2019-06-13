<?php

namespace App\Http\Controllers\Premises;

use App\Models\Lokaal;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Premises
 */
class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user']);
    }

    /**
     * Method for display the overview from the premises in the domain.
     *
     * @param  Lokaal $premises The database model class for the premises in the application.
     * @return Renderable
     */
    public function index(Lokaal $premises): Renderable
    {
        return view('premises.dashboard', ['premises' => $premises->all()]);
    }

    /**
     * Method for displaying he view for storing an new premise.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        // TODO: Create and implement routes
        // TODO: Create view.
        // TODO: Create controller
    }
}
