<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

/**
 * Class HomeController
 * 
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->only('indexFrontend');
        $this->middleware(['auth', 'forbid-banned-user'])->only(['indexBackend']);
    }

    /**
     * Display the welcome page of the application. 
     * 
     * @return Renderable
     */
    public function indexFrontend(): Renderable 
    {
        return view('auth.login');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function indexBackend(): Renderable
    {
        return view('home');
    }
}
