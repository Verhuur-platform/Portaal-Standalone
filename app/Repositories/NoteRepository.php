<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class NoteRepository
 *
 * @package App\Repositories
 */
class NoteRepository extends Model
{
    /**
     * Get all of the owning notable models.
     *
     * @return MorphTo
     */
    public function notable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Data relation for accessing the author relation.
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}