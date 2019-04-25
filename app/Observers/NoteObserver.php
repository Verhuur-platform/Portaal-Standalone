<?php

namespace App\Observers;

use App\Models\Note;

/**
 * Class NoteObserver
 *
 * @package App\Observers
 */
class NoteObserver
{
    /**
     * Handle the note "created" event.
     *
     * @param  Note  $note  The entity from the created note.
     * @return void
     */
    public function created(Note $note): void
    {
        $user = auth()->user();
        $note->author()->associate($user)->save();
    }
}
