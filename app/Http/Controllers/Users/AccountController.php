<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

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
        return view('account.security', ['user' => Auth::user()]);
    }
}
