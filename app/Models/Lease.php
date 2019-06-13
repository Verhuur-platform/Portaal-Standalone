<?php

namespace App\Models;

use App\Repositories\LeaseRepository;
use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Lease
 *
 * @package App\Models
 */
class Lease extends LeaseRepository
{
    /**
     * Mass-assign fields for the database table.
     *
     * @return array
     */
    protected $fillable = ['persons', 'start_date', 'end_date', 'tenant_id', 'status_id'];

    /**
     * Mutate database fields to date fields.
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date'];

    /**
     * Data relation for the tenant from the lease.
     *
     * @return BelongsTo
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Data relation for the lease status.
     *
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Data relation for the notes that are attached to the lease.
     *
     * @return MorphMany
     */
    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'notable');
    }

    /**
     * Data relation for the successor from the lease in the application.
     *
     * @return BelongsTo
     */
    public function successor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Attributes to create the lease period.
     *
     * @return string
     */
    public function getPeriodAttribute(): string
    {
        return "{$this->start_date->format('d/m/Y')} - {$this->end_date->format('d/m/Y')}";
    }
}
