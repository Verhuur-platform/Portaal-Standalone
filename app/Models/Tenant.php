<?php

namespace App\Models;

use App\Repositories\TenantRepository;

/**
 * Class Tenant
 *
 * @package App\Models
 */
class Tenant extends TenantRepository
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['full_name', 'lastname', 'firstname', 'email', 'tel_nr'];
}
