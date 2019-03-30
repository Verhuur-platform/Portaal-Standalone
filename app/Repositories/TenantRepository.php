<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class TenantRepository
 *
 * @package App\Repositories
 */
class TenantRepository extends Model
{
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
}