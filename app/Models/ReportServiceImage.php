<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportServiceImage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Get the layanan that owns the LayananGambar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reportService(): BelongsTo
    {
        return $this->belongsTo(ReportService::class, 'report_service_id');
    }
}
