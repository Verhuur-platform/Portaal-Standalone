<?php

namespace App\Repositories;

use App\Models\Note;
use App\Models\Tenant;
use App\Traits\FlashMessenger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
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
     * @param  string|null $filter The name of the filter group.
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
     * Custom function for finding an tenant in the application or creating them. 
     * 
     * ->firstOrCreate(); is not used because we need logging and there is already 
     * defined an ->createTenant() method in the application. 
     * 
     * @param  Request $input The reguest instance that holds all the request data.
     * @return Tenant
     */
    public function getOrCreate(Request $input): Tenant 
    {

        $matchCriteria = [['firstname', $input->firstname], ['lastname', $input->lastname], ['email', $input->email]];
        $tenant = $this->where($matchCriteria)->first();

        // No tenant if found with the matching criteria in the application. 
        // So we need to create on in the application. 
        if (! $tenant) {
            $input->merge(['full_name' => "{$input->firstname} {$input->lastname}"]);
            return $this->createTenant($input->all());
        } 

        return $tenant;
    }

    /**
     * Method for logging and creating a new tenant in the application.
     *
     * @param  array $attributes The attributes that needs to be saved.
     * @return Tenant|null
     */
    public function createTenant(array $attributes): ?Tenant
    {
        $tenant = $this->create($attributes); 

        if ($tenant) {
            auth()->user()->logActivity('Huurders', "Heeft {$tenant->full_name} toegevoegd als huurder.");
            $this->flashSuccess($this->full_name . ' is toegevoegd als huurder in het portaal.');
        }

        return $tenant;
    }
}