<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    use HasFactory, Uuids;
    protected $guarded = ['id'];

    /**
     * Get the layanan that owns the LayananGambar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }


    /**
     * User relation to service facility model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function extra_fees(): HasMany
    {
        return $this->HasMany(ExtraFee::class);
    }
}
