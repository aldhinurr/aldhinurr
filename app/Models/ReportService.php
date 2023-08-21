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
     * User relation to ReportServiceImage model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function report_service_images(): HasMany
    {
        return $this->HasMany(ReportServiceImage::class);
    }

    public function get_count_data(array $status)
    {
        return ReportService::whereIn('status', $status)->count();
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
