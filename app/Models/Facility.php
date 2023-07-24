<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class Facility extends Model
{
    use HasFactory, HasRoles;
    protected $guarded = ['id'];

    /**
     * User relation to service facility model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function service_facilities(): HasMany
    {
        return $this->HasMany(ServiceFacility::class);
    }
}
