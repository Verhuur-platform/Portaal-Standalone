<?php

namespace App\Models;

use App\Repositories\LeaseRepository;
use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * Data relation for the tenant from the lease. 
     * 
     * @return BelongsTo
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
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
}
