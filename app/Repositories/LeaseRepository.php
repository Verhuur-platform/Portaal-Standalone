<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Lease;
use Illuminate\Database\Eloquent\Model;


/**
 * Class LeaseRepository 
 * 
 * @package App\Repositories
 */
class LeaseRepository extends Model
{
    public function getByGroup(?string $filter = null): Builder
    {
        $leases = Lease::query();
        return $leases; // No matching filter is found. So return a builder instance without any scopes on it
    }
}