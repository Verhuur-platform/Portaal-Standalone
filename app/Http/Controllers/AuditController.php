<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Spatie\Activitylog\Models\Activity;

/**
 * Class AuditController 
 *
 * Controller fo
 *
 * @package App\Http\Controller
 */
class AuditController extends Controller
{
    /**
     * AuditController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:webmaster', 'forbid-banned-user']);
    }

    /**
     * Method for displaying all the audit logs in the application. 
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $logs = Activity::orderBy('created_at', 'DESC')->simplePaginate();
        return view('audit.index', compact('logs'));
    }
}
