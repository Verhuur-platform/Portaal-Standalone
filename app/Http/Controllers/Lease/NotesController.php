<?php

namespace App\Http\Controllers\Lease;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lease;

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

    /**
     * Method for viewing the notes that are attached to the lease. 
     * 
     * @param  Lease $lease The resource entity from the given lease in the application. 
     * @return Renderable
     */
    public function index(Lease $lease): Renderable
    {
        $notes = $lease->notes()->simplePaginate();
        return view('lease.notes.dashboard', compact('notes'));
    }
}
