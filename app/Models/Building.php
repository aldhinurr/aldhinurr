<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory, Uuids;
    protected $guarded = ['id'];

    /**
     * Building relation to floor model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function floors(): HasMany
    {
        return $this->HasMany(Floor::class);
    }
}
