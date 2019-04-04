<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenant;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;

/**
 * Class NotesController
 *
 * @package App\Http\Controllers\Tenants
 */
class NotesController extends Controller
{
    /**
     * NotesController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:webmaster|gebruiker', 'forbid-banned-user']);
    }

    /**
     * Method for displaying all the notes for the given user.
     *
     * @param  null|string $filter The applied filter for the notes.
     * @param  Tenant      $tenant The database resource from the given user.
     * @return Renderable
     */
    public function index(Tenant $tenant, ?string $filter = null): Renderable
    {
        if ($filter === 'auteur') {
            $notes = $tenant->whereHas('notes', function (Builder $query): void {
                $query->whereAuthorId(auth()->user()->id);
            })->simplePaginate();
        }

        else {
            $notes = $tenant->notes()->simplePaginate();
        }

        return view('tenants.notes.index', compact('tenant', 'notes'));
    }

    /**
     * Method for creating an new note for an tenant.
     *
     * @param  Tenant $tenant The storage entity from the given tenant
     * @return Renderable
     */
    public function create(Tenant $tenant): Renderable
    {
        return view('tenants.notes.create', compact('tenant'));
    }
}
