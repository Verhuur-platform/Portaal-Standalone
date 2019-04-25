<?php

namespace App\Repositories;

use App\Models\Note;
use App\Models\Tenant;
use App\Traits\FlashMessenger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

/**
 * Class TenantRepository
 *
 * @package App\Repositories
 */
class TenantRepository extends Model
{
    use FlashMessenger;

    /**
     * Get all of the post's comments.
     *
     * @return MorphMany
     */
    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'notable');
    }

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
     * Remove an tenant in the application.
     *
     * @throws \Exception <- Native PHP class
     * @return void
     */
    public function remove(): void
    {
        if ($this->delete()) {
            $this->flashInfo($this->full_name . ' is verwijderd als huurder in de applicatie.');
            Auth::user()->logActivity('Huurders', "Heeft {$this->full_name} verwijderd als huurder");
        }
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
            $this->flashSuccess($this->full_name . ' is toegevoegd als huurder in het portaal.');
        }

        return $tenant;
    }
}