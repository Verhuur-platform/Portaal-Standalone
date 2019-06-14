<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Ticket
 *
 * @package App\Models
 */
class Ticket extends Model
{
    /**
     * Mass-assignable fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'is_open'];

    /**
     * Data relation for the user that is assigned to the ticket.
     *
     * @return BelongsTo
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Data relation for the creator of the ticket.
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
