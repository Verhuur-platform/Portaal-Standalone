<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Lokaal
 *
 * @package App\Models
 */
class Lokaal extends Model
{
    /**
     * The database table name for the model.
     *
     * @var string
     */
    protected $table = 'lokalen';

    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Data relation for getting all the tickets from the premise.
     *
     * @return HasMany
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Method for getting all the open tickets from the premise.
     *
     * @return Builder
     */
    public function openTickets(): Builder
    {
        return $this->whereHas('tickets', static function (Builder $query) {
            $query->where('is_open', true);
        });
    }

    /**
     * Method for getting all the closed tickets from the premise.
     *
     * @return HasMany
     */
    public function closedTickets(): HasMany
    {
        return $this->whereHas('tickets', static function (Builder $query) {
           $query->where('is_open', true);
        });
    }
}
