<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RepairService extends Model
{
    use HasFactory, Uuids;
    protected $guarded = ['id'];

    /**
     * RepairService relation to RepairServiceDetail model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function RepairServiceDetails(): HasMany
    {
        return $this->HasMany(RepairServiceDetail::class);
    }

    /**
     * Get the user that owns the ReportService
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'email');
    }
}
