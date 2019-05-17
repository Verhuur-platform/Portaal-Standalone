<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class LeaseScopes
 *
 * @package App\Models\Scopes
 */
class LeaseScopes extends Builder
{
    public function upcoming(): Builder
    {
        $this->where('end_date', '>', now());
        return $this;
    }
}
