<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * User relation to service facility model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function service_facilities(): HasMany
    {
        return $this->HasMany(ServiceFacility::class);
    }

    public function get_count_data($type)
    {
        return Layanan::where('type', $type)->where('status', 'AKTIF')->count();
    }

    public function get_home_data($type, $limit)
    {
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $dateNow = $now->format('Y-m-d');

        return Layanan::with(['layanan_gambars'])
            ->select('layanans.*', DB::raw("coalesce(jml_sewa, 0) as jml_sewa"), DB::raw("coalesce(is_sewa, 0) as is_sewa"))
            ->distinct()
            ->leftJoin(
                DB::raw(
                    "(select count(r.id) jml_sewa, r.layanan_id from reservations r 
                    inner join layanans l2 on r.layanan_id = l2.id 
                    where r.status not in ('DIBATALKAN')
                    group by r.layanan_id) b"
                ),
                function ($join) {
                    $join->on('b.layanan_id', "=", "layanans.id");
                }
            )
            ->leftJoin(
                DB::raw(
                    "(select 1 is_sewa, layanan_id 
                    from reservations r 
                    inner join layanans l2 on r.layanan_id = l2.id 
                    where r.status = 'DISETUJUI'
                    and r.end_date >= " . $dateNow . ") c"
                ),
                function ($join) {
                    $join->on('c.layanan_id', "=", "layanans.id");
                }
            )
            ->where('type', $type)->where('status', 'AKTIF')
            ->orderby('jml_sewa', 'desc')->orderby('layanans.name', 'asc')
            ->limit($limit)->get();
    }

    public function get_page_data($type, $show, $params = null)
    {
        $r_status = 'DISETUJUI';
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $dateNow = $now->format('Y-m-d');
        if ($params->start_date) {
            $start_date = strtotime(str_replace("/", "-", $params->start_date));
            $dateNow = date('Y-m-d', $start_date);
        }

        return Layanan::with(['layanan_gambars'])
            ->select('layanans.*', DB::raw("coalesce(b.jml_sewa, 0) as jml_sewa")) //, DB::raw("coalesce(c.sewa, 0) as sewa"))
            ->distinct()
            ->leftJoin(
                DB::raw(
                    "(select count(r.id) jml_sewa, r.layanan_id from reservations r 
                    inner join layanans l2 on r.layanan_id = l2.id 
                    where r.status not in ('DIBATALKAN')
                    group by r.layanan_id) b"
                ),
                function ($join) {
                    $join->on('b.layanan_id', "=", "layanans.id");
                }
            )
            // ->leftJoin(
            //     DB::raw(
            //         "(select 1 as sewa, layanan_id 
            //         from reservations r 
            //         where r.status = '$r_status'
            //         and r.end_date >= $dateNow) c"
            //     ),
            //     function ($join) {
            //         $join->on('c.layanan_id', "=", "layanans.id");
            //     }
            // )
            ->where('type', $type)->where('status', 'AKTIF')
            ->when($params->location != null, function ($q) use ($params) {
                $q->where('location', $params->location);
            })
            ->orderby('jml_sewa', 'desc')->orderby('layanans.name', 'asc')
            ->paginate($show);
    }
}
