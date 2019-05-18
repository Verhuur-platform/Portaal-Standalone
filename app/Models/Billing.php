<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Billing
 *
 * @package App\Models
 */
class Billing extends Model
{
    /**
     * Mass-assignable fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['group_or_organisation', 'address', 'postal', 'city', 'country'];
}
