<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairServiceDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Get the repairService that owns the RepairServiceDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function repairService(): BelongsTo
    {
        return $this->belongsTo(RepairService::class, 'repair_service_id');
    }

    /**
     * Get the floor that owns the RepairServiceDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function floor(): BelongsTo
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }
}
