<?php

namespace App\Http\Controllers\Lease;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class NotesController 
 * 
 * @package App\Http\Controllers\Lease
 */
class NotesController extends Controller
{
    /**
     * NotesController constructor 
     * 
     * @return void 
     */
    public function __construct() 
    {
        $this->middleware(['auth', 'forbid-banned-user']);
    }

    
}
