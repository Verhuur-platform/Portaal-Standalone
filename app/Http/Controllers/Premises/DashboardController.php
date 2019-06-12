<?php

namespace App\Http\Controllers\Premises;

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
     * @return Renderable
     */
    public function index(): Renderable
    {

    }
}
