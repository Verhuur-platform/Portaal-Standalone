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

        // Get all the notes that are attached to the tenant. 
        // We also paginate them to reduce the view size in the application. 
        else {
            $notes = $tenant->notes()->simplePaginate();
        }

        return view('tenants.notes.index', compact('tenant', 'notes'));
    }

    /**
     * Method to display an note in the application. 
     * 
     * @param  Note $note   The resource entity from the given note.   
     * @return Renderable 
     */
    public function show(Note $note): Renderable 
    {
        return view('tenants.notes.show', compact('note'));
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

    /**
     * Method for displaying the edit view from a note. 
     * 
     * @param  Note $note   The storage entity from the given note. 
     * @return Renderable 
     */
    public function edit(Note $note): Renderable 
    {
        $this->authorize('update', $note);
        return view('tenants.notes.edit', compact('note'));
    }

    /**
     * Method for update a note from the tenant in the application.
     * 
     * @param  TenantsNoteValidator $input  The form request class that holds all the request information. 
     * @param  Note                 $note   The resource entity from the given note.
     * @return RedirectResponse 
     */
    public function update(TenantsNoteValidator $input, Note $note): RedirectResponse 
    {
        $this->authorize('update', $note);
    
        if ($note->update($input->all())) { // The note has been updated in the application. 
            $input->user()->logActivity('Notities', "Heeft een notitie aangepast van de huurder {$note->notable->full_name}.");
            flash('De notitie is aangepast in het verhuur portaal.');
        }

        return redirect()->route('tenant.notes.edit', $note);
    }

    /**
     * Method for deleting an tenant note in the application. 
     * 
     * @param  Note $note   The resource entity from the given note. 
     * @return RedirectResponse 
     */
    public function destroy(Note $note): RedirectResponse 
    {
        $user = auth()->user(); 

        if ($user->can('delete', $note) && $note->delete()) {
            $user->logActivity('Notities', "Heeft een notitie van {$note->notable->full_name} verwijderd in het protaal.");
        }

        return redirect()->route('tenant.notes', $note->notable);
    }
}
