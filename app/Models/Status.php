<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 *
 * @package App\Models
 */
class Status extends Model
{
    /**
     * Mass-assignable fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['status', 'css_class'];
}
