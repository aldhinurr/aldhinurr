<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
