<?php

namespace App\Repositories;

use App\Models\Tenant;
use App\Traits\FlashMessenger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class TenantRepository
 *
 * @package App\Repositories
 */
class TenantRepository extends Model
{
    use FlashMessenger;

    /**
     * Get the tenants by the given group. Defaults to all users.
     *
     * @param  null|string $filter The name of the filter group.
     * @return Builder
     */
    public function getByGroup(?string $filter = null): Builder
    {
        $query = $this->newQuery();
        return $query;
    }

    /**
     * Method for logging and creating a new tenant in the application.
     *
     * @param  array $attributes The attributes that needs to be saved.
     * @return Tenant|null
     */
    public function createTenant(array $attributes): ?Tenant
    {
        if ($tenant = $this->create($attributes)) {
            auth()->user()->logActivity('Huurders', "Heeft {$tenant->full_name} toegevoegd als huurder.");
            $this->flashSuccess($tenant->full_name . ' is toegevoegd als huurder in het portaal.');
        }

        return $tenant;
    }
}