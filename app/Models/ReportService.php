<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportService extends Model
{
    use HasFactory, Uuids;
    protected $guarded = ['id'];


    /**
     * User relation to layanan model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function report_service_images(): HasMany
    {
        return $this->HasMany(ReportServiceImage::class);
    }

    public function get_count_data($status)
    {
        return Layanan::where('status', $status)->count();
    }

    /**
     * Get the layanan that owns the LayananGambar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'email');
    }
}
