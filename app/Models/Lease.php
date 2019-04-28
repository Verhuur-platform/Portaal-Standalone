<?php

namespace App\Models;

use App\Repositories\LeaseRepository;

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
    protected $fillable = [];

    /**
     * Data relation for the tenant from the lease. 
     * 
     * @return BelongsTo
     */
    public function tenant(): BelongsTo 
    {
        return $this->belongsTo(Tenant::class);
    }
}
