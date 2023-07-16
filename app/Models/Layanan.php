<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class Layanan extends Model
{
    use HasFactory, HasRoles;
    protected $guarded = ['id'];

    /**
     * User relation to layanan model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function layanan_gambars(): HasMany
    {
        return $this->HasMany(LayananGambar::class);
    }
}
