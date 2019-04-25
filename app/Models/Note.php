<?php

namespace App\Models;

use App\Repositories\NoteRepository;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Note
 *
 * @package App\Models
 */
class Note extends NoteRepository
{
    /**
     * Mass-assign fields for the database table.
     *
     * @return array
     */
    protected $fillable = ['titel', 'content'];
}
