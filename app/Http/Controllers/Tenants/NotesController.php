<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Requests\Lease\TenantsNoteValidator;
use App\Models\Tenant;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\Note;

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
            $matchThese = [['notable_type', 'App\Models\Tenant'], ['notable_id', $tenant->id], ['author_id', auth()->user()->id]];
            $notes = Note::where($matchThese)->simplePaginate();
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

    /**
     * Method for storing the note from the tenant in the application.
     *
     * @see \App\Observers\NoteObserver::created() <- Assign author to the note.
     *
     * @param  TenantsNoteValidator $input  The request class that handles the validation.
     * @param  Tenant               $tenant The storage entity from the tenant.
     * @return RedirectResponse
     */
    public function store(TenantsNoteValidator $input, Tenant $tenant): RedirectResponse
    {
        if ($tenant->notes()->create($input->all())) {
            auth()->user()->logActivity('Huurders', "Heeft een notitie voor de huurder {$tenant->full_name} toegevoegd.");
            $tenant->flashInfo('De notitie is toegevoegd');
        }

        return redirect()->route('tenant.notes.create', $tenant);
    }
}
