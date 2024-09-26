<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Facility;
use App\Models\Floor;
use App\Models\Layanan;
use App\Models\RepairService;
use App\Models\ReportService;
use App\Models\Reservation;
use App\Models\ServiceFacility;
use DateInterval;
use DateTime;
use DateTimeZone;
use DB;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Nette\Utils\Paginator as UtilsPaginator;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = new Layanan;
        $report = new ReportService;

        // Ruangan
        $count_rooms = $layanan->get_count_data('RUANG');
        $rooms = $layanan->get_home_data('RUANG', 6);

        // Ruang Kuliah Umum
        $count_rku = $layanan->get_count_data('RKU');
        $rku = $layanan->get_home_data('RKU', 6);

        // Kendaraan
        $count_cars = $layanan->get_count_data('KENDARAAN');
        $cars = $layanan->get_home_data('KENDARAAN', 6);

        // Rumah Susun
        $count_rumah = $layanan->get_count_data('RUMAH SUSUN');
        $rumah = $layanan->get_home_data('RUMAH SUSUN', 6);

        // Selasar
        $count_selasar = $layanan->get_count_data('SELASAR');
        $selasar = $layanan->get_home_data('SELASAR', 6);

        // Lapangan
        $count_lapangan = $layanan->get_count_data('LAPANGAN');
        $lapangan = $layanan->get_home_data('LAPANGAN', 6);

        // Peralatan
        $count_peralatan = $layanan->get_count_data('PERALATAN');
        $peralatan = $layanan->get_home_data('PERALATAN', 6);

        // Laporan
        $report_done = $report->get_count_data(['SELESAI']);
        $report_waiting = $report->get_count_data(['MENUNGGU']);
        $report_process = $report->get_count_data(['SEDANG DIKERJAKAN', 'SEDANG DIPERIKSA']);


        return view('website.index', [
            'count_rooms' => $count_rooms,
            'count_rku' => $count_rku,
            'count_cars' => $count_cars,
            'count_rumah' => $count_rumah,
            'count_selasar' => $count_selasar,
            'count_lapangan' => $count_lapangan,
            'count_peralatan' => $count_peralatan,
            'report_done' => $report_done,
            'report_waiting' => $report_waiting,
            'report_process' => $report_process,
            'rooms' => $rooms,
            'cars' => $cars,
            'rku' => $rku,
            'rumah' =>$rumah,
            'selasar' =>$selasar,
            'lapangan' => $lapangan,
            'peralatan' => $peralatan,
        ]);
    }

    public function showLayanan($priceCondition)
    {
        $query = Layanan::select('layanans.id', 'layanans.type', 'layanans.unit_pengelola', 'layanans.name', 'layanans.address', 'layanans.large', 'layanans.capacity', 'layanans.price', 'layanans.price_for', 'layanan_gambars.picture')
            ->leftJoin('layanan_gambars', 'layanan_gambars.layanan_id', '=', 'layanans.id')
            ->whereIn('layanans.type', ['rku', 'ruang', 'kendaraan', 'selasar', 'lapangan'])
            ->where('layanans.status', '=', 'AKTIF');
    
        if ($priceCondition === 'free') {
            $query->where('layanans.price', '=', 0);
        } elseif ($priceCondition === 'paid') {
            $query->where('layanans.price', '>', 0);
        }
    
        $results = $query->orderBy('layanans.created_at', 'DESC')
                         ->limit(9)
                         ->get();
    
        return $results;
    }

    public function dataLayanan(Request $request, $action)
    {
        if ($action === 'sewa') {
            $results = $this->showLayanan('paid'); // Layanan dengan harga di atas 0
        } elseif ($action === 'resource') {
            $results = $this->showLayanan('free'); // Layanan dengan harga 0
        }
        
        $layanan = new Layanan;
        $rooms = $layanan->get_page_data('RUANG', 18, $request);
        $rku = $layanan->get_page_data('RKU', 18, $request);
        $cars = $layanan->get_page_data('KENDARAAN', 18, $request);
        $lapangan = $layanan->get_page_data('LAPANGAN', 18, $request);
        $peralatan = $layanan->get_page_data('PERALATAN', 18, $request);
        $selasar = $layanan->get_page_data('SELASAR', 18, $request);
        $rumah = $layanan->get_page_data('RUMAH', 18, $request);

        // is_sewa
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $addThreedays = $now->add(DateInterval::createFromDateString('3 days'));
        $dateSewa = $addThreedays->format('Y-m-d');
        if ($request->start_date) {
            $start_date = strtotime(str_replace("/", "-", $request->start_date));
            $dateSewa = date('Y-m-d', $start_date);
        }

        $sewa = Reservation::select('layanan_id')
            ->whereNotIn('status', ['DITOLAK', 'DIBATALKAN', 'DIALIHKAN', 'SELESAI'])
            ->where('start_date', '<=', $dateSewa . ' 23:59')
            ->where('end_date', '>=', $dateSewa . ' 00:01')
            ->get();
        
        $is_sewa = array();
        if (count($sewa) > 0) {
            foreach ($sewa as $s => $val) {
                array_push($is_sewa, $val->layanan_id);
            }
        }

        // Query untuk mendapatkan data unit_pengelola
        $units = DB::table('layanans')
            ->distinct()
            ->select('unit_pengelola')
            ->where('status', 'AKTIF')
            ->whereNull('deleted_by')
            ->whereNull('deleted_at')
            ->orderBy('unit_pengelola')
            ->get();

        if ($request->ajax()) {
            if ($request->type === 'rooms') {
                $view = view('website.rooms._data', compact('rooms', 'is_sewa'))->render();
            } elseif ($request->type === 'rku') {
                $view = view('website.rku._data', compact('rku', 'is_sewa'))->render();
            } elseif ($request->type === 'cars') {
                $view = view('website.cars._data', compact('cars', 'is_sewa'))->render();
            } elseif ($request->type === 'lapangan') {
                $view = view('website.lapangan._data', compact('lapangan', 'is_sewa'))->render();
            } elseif ($request->type === 'peralatan') {
                $view = view('website.peralatan._data', compact('peralatan', 'is_sewa'))->render();
            } elseif ($request->type === 'selasar') {
                $view = view('website.selasar._data', compact('selasar', 'is_sewa'))->render();
            } elseif ($request->type === 'rumah') {
                $view = view('website.rumah._data', compact('rumah', 'is_sewa'))->render();
            }
            return response()->json(['html' => $view]);
        }

        if ($action === 'sewa') {
            return view('website.sewa.index', compact('results', 'rooms', 'rku', 'cars', 'lapangan', 'peralatan', 'selasar', 'rumah', 'is_sewa', 'units'));
        } elseif ($action === 'resource') {
            return view('website.resource.index', compact('results', 'rooms', 'rku', 'cars', 'lapangan', 'peralatan', 'selasar', 'rumah', 'is_sewa', 'units'));
        }
    }

    public function getUnitPengelola(Request $action)
    {
        $units = DB::table('layanans')
                    ->distinct()
                    ->select('unit_pengelola')
                    ->where('status', 'AKTIF')
                    ->whereNull('deleted_by')
                    ->whereNull('deleted_at')
                    ->orderBy('unit_pengelola')
                    ->get();

                    if ($action === 'sewa') {
                        return view('website.sewa.index', compact('units'));
                    } elseif ($action === 'resource') {
                        return view('website.resource.index', compact('units'));
                    }       
                }

    public function sewa(Request $request)
    {
        return $this->dataLayanan($request, 'sewa');
    }

    public function resource(Request $request)
    {
        return $this->dataLayanan($request, 'resource');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function rooms(Request $request, $getDataMethod)
    {
        $layanan = new Layanan;
        $rooms = $layanan->$getDataMethod('RUANG', 18, $request);
    
        // is_sewa
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $addThreedays = $now->add(DateInterval::createFromDateString('3 days'));
        $dateSewa = $addThreedays->format('Y-m-d');
        if ($request->start_date) {
            $start_date = strtotime(str_replace("/", "-", $request->start_date));
            $dateSewa = date('Y-m-d', $start_date);
        }
    
        $sewa = Reservation::select('layanan_id')
            ->whereNotIn('status', ['DITOLAK', 'DIBATALKAN', 'DIALIHKAN', 'SELESAI'])
            ->where('start_date', '<=', $dateSewa . ' 23:59')
            ->where('end_date', '>=', $dateSewa . ' 00:01')
            ->get();
    
        $is_sewa = array();
        if (count($sewa) > 0) {
            foreach ($sewa as $s => $val) {
                array_push($is_sewa, $val->layanan_id);
            }
        }
    
        if ($request->ajax()) {
            $rooms = $layanan->$getDataMethod('RUANG', 18, $request);
            $view = view('website.rooms._data', compact('rooms', 'is_sewa'))->render();
            return response()->json(['html' => $view]);
        }
    
        return view('website.rooms.index', compact('rooms', 'is_sewa'));
    }

    public function rooms_sewa(Request $request)
    {
        return $this->rooms($request, 'get_page_data');
    }
    
    public function rooms_resource(Request $request)
    {
        return $this->rooms($request, 'get_resource_data');
    }    

    public function rku(Request $request, $getDataMethod)
    {
        $layanan = new Layanan;
        $rku = $layanan->$getDataMethod('RKU', 18, $request);

        // is_sewa
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $addThreedays = $now->add(DateInterval::createFromDateString('3 days'));
        $dateSewa = $addThreedays->format('Y-m-d');
        if ($request->start_date) {
            $start_date = strtotime(str_replace("/", "-", $request->start_date));
            $dateSewa = date('Y-m-d', $start_date);
        }

        $sewa = Reservation::select('layanan_id')
            ->whereNotIn('status', ['DITOLAK', 'DIBATALKAN', 'DIALIHKAN', 'SELESAI'])
            ->where('start_date', '<=', $dateSewa . ' 23:59')
            ->where('end_date', '>=', $dateSewa . ' 00:01')
            ->get();

        $is_sewa = array();
        if (count($sewa) > 0) {
            foreach ($sewa as $s => $val) {
                array_push($is_sewa, $val->layanan_id);
            }
        }

        if ($request->ajax()) {
            $rku = $layanan->$getDataMethod('RKU', 18, $request);
            $view = view('website.rku._data', compact('rku', 'is_sewa'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website.rku.index', compact('rku', 'is_sewa'));
    }

    public function rku_sewa(Request $request)
    {
        return $this->rku($request, 'get_page_data');
    }
    
    public function rku_resource(Request $request)
    {
        return $this->rku($request, 'get_resource_data');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cars(Request $request, $getDataMethod)
    {
        $layanan = new Layanan;
        $cars = $layanan->$getDataMethod('KENDARAAN', 18, $request);

        // is_sewa
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $addThreedays = $now->add(DateInterval::createFromDateString('3 days'));
        $dateSewa = $addThreedays->format('Y-m-d');
        if ($request->start_date) {
            $start_date = strtotime(str_replace("/", "-", $request->start_date));
            $dateSewa = date('Y-m-d', $start_date);
        }

        $sewa = Reservation::select('layanan_id')
            ->whereNotIn('status', ['DITOLAK', 'DIBATALKAN', 'DIALIHKAN', 'SELESAI'])
            ->where('start_date', '<=', $dateSewa . ' 23:59')
            ->where('end_date', '>=', $dateSewa . ' 00:01')
            ->get();

        $is_sewa = array();
        if (count($sewa) > 0) {
            foreach ($sewa as $s => $val) {
                array_push($is_sewa, $val->layanan_id);
            }
        }

        if ($request->ajax()) {
            $cars = $layanan->$getDataMethod('KENDARAAN', 18, $request);
            $view = view('website.cars._data', compact('cars', 'is_sewa'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website.cars.index', compact('cars', 'is_sewa'));
    }

    public function cars_sewa(Request $request)
    {
        return $this->cars($request, 'get_page_data');
    }
    
    public function cars_resource(Request $request)
    {
        return $this->cars($request, 'get_resource_data');
    }

    public function selasar(Request $request, $getDataMethod)
    {
        $layanan = new Layanan;
        $selasar = $layanan->$getDataMethod('SELASAR', 18, $request);

        // is_sewa
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $addThreedays = $now->add(DateInterval::createFromDateString('3 days'));
        $dateSewa = $addThreedays->format('Y-m-d');
        if ($request->start_date) {
            $start_date = strtotime(str_replace("/", "-", $request->start_date));
            $dateSewa = date('Y-m-d', $start_date);
        }

        $sewa = Reservation::select('layanan_id')
            ->whereNotIn('status', ['DITOLAK', 'DIBATALKAN', 'DIALIHKAN', 'SELESAI'])
            ->where('start_date', '<=', $dateSewa . ' 23:59')
            ->where('end_date', '>=', $dateSewa . ' 00:01')
            ->get();

        $is_sewa = array();
        if (count($sewa) > 0) {
            foreach ($sewa as $s => $val) {
                array_push($is_sewa, $val->layanan_id);
            }
        }

        if ($request->ajax()) {
            $selasar = $layanan->$getDataMethod('SELASAR', 18, $request);
            $view = view('website.selasar._data', compact('selasar', 'is_sewa'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website.selasar.index', compact('selasar', 'is_sewa'));
    }

    public function selasar_sewa(Request $request)
    {
        return $this->selasar($request, 'get_page_data');
    }
    
    public function selasar_resource(Request $request)
    {
        return $this->selasar($request, 'get_resource_data');
    }

    public function rumah(Request $request, $getDataMethod)
    {
        $layanan = new Layanan;
        $rumah = $layanan->$getDataMethod('RUMAH SUSUN', 18, $request);

        // is_sewa
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $addThreedays = $now->add(DateInterval::createFromDateString('3 days'));
        $dateSewa = $addThreedays->format('Y-m-d');
        if ($request->start_date) {
            $start_date = strtotime(str_replace("/", "-", $request->start_date));
            $dateSewa = date('Y-m-d', $start_date);
        }

        $sewa = Reservation::select('layanan_id')
            ->whereNotIn('status', ['DITOLAK', 'DIBATALKAN', 'DIALIHKAN', 'SELESAI'])
            ->where('start_date', '<=', $dateSewa . ' 23:59')
            ->where('end_date', '>=', $dateSewa . ' 00:01')
            ->get();

        $is_sewa = array();
        if (count($sewa) > 0) {
            foreach ($sewa as $s => $val) {
                array_push($is_sewa, $val->layanan_id);
            }
        }

        if ($request->ajax()) {
            $rumah = $layanan->$getDataMethod('RUMAH SUSUN', 18, $request);
            $view = view('website.rumah._data', compact('rumah', 'is_sewa'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website.rumah.index', compact('rumah', 'is_sewa'));
    }

    public function rumah_sewa(Request $request)
    {
        return $this->rumah($request, 'get_page_data');
    }
    
    public function rumah_resource(Request $request)
    {
        return $this->rumah($request, 'get_resource_data');
    }


    public function lapangan(Request $request, $getDataMethod)
    {
        $layanan = new Layanan;
        $lapangan = $layanan->$getDataMethod('LAPANGAN', 18, $request);

        // is_sewa
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $addThreedays = $now->add(DateInterval::createFromDateString('3 days'));
        $dateSewa = $addThreedays->format('Y-m-d');
        if ($request->start_date) {
            $start_date = strtotime(str_replace("/", "-", $request->start_date));
            $dateSewa = date('Y-m-d', $start_date);
        }

        $sewa = Reservation::select('layanan_id')
            ->whereNotIn('status', ['DITOLAK', 'DIBATALKAN', 'DIALIHKAN', 'SELESAI'])
            ->where('start_date', '<=', $dateSewa . ' 23:59')
            ->where('end_date', '>=', $dateSewa . ' 00:01')
            ->get();

        $is_sewa = array();
        if (count($sewa) > 0) {
            foreach ($sewa as $s => $val) {
                array_push($is_sewa, $val->layanan_id);
            }
        }

        if ($request->ajax()) {
            $lapangan = $layanan->$getDataMethod('LAPANGAN', 18, $request);
            $view = view('website.lapangan._data', compact('lapangan', 'is_sewa'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website.lapangan.index', compact('lapangan', 'is_sewa'));
    }

    public function lapangan_sewa(Request $request)
    {
        return $this->lapangan($request, 'get_page_data');
    }
    
    public function lapangan_resource(Request $request)
    {
        return $this->lapangan($request, 'get_resource_data');
    }

    public function peralatan(Request $request, $getDataMethod)
    {
        $layanan = new Layanan;
        $peralatan = $layanan->$getDataMethod('PERALATAN', 18, $request);

        // is_sewa
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $addThreedays = $now->add(DateInterval::createFromDateString('3 days'));
        $dateSewa = $addThreedays->format('Y-m-d');
        if ($request->start_date) {
            $start_date = strtotime(str_replace("/", "-", $request->start_date));
            $dateSewa = date('Y-m-d', $start_date);
        }

        $sewa = Reservation::select('layanan_id')
            ->whereNotIn('status', ['DITOLAK', 'DIBATALKAN', 'DIALIHKAN', 'SELESAI'])
            ->where('start_date', '<=', $dateSewa . ' 23:59')
            ->where('end_date', '>=', $dateSewa . ' 00:01')
            ->get();

        $is_sewa = array();
        if (count($sewa) > 0) {
            foreach ($sewa as $s => $val) {
                array_push($is_sewa, $val->layanan_id);
            }
        }

        if ($request->ajax()) {
            $peralatan = $layanan->$getDataMethod('PERALATAN', 18, $request);
            $view = view('website.peralatan._data', compact('peralatan', 'is_sewa'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website.peralatan.index', compact('peralatan', 'is_sewa'));
    }

    public function peralatan_sewa(Request $request)
    {
        return $this->peralatan($request, 'get_page_data');
    }
    
    public function peralatan_resource(Request $request)
    {
        return $this->peralatan($request, 'get_resource_data');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $sewa = Reservation::with(["layanan", "user"])->paginate(10);
        $report = ReportService::with(["report_service_images", "user"])->paginate(10);
        $repair = RepairService::with(["RepairServiceDetails", "user"])->paginate(10);
        if ($request->ajax()) {
            // Reservation::;
            $sewa = Reservation::select(
                'reservations.*',
                'layanans.type',
                'layanans.name',
                'layanans.location',
                'users.first_name',
                'users.last_name',
                'users.email'
            )
                ->join('users', 'users.email', '=', 'reservations.created_by')
                ->join('layanans', 'layanans.id', '=', 'reservations.layanan_id')
                ->whereNotIn('reservations.status', ['EXPIRED', 'DIBATALKAN'])
                ->when($request->type, function ($q) use ($request) {
                    $q->where('layanans.type', $request->type);
                })
                ->when($request->search != null, function ($q) use ($request) {
                    $q->where(function ($query) use ($request) {
                        $query->where('layanans.name', 'like', '%' . $request->search . '%')
                            ->orWhere('reservations.kode_sewa', 'like', '%' . $request->search . '%')
                            ->orWhere('reservations.unit', 'like', '%' . $request->search . '%');
                    });
                })
                ->when($request->only_me != null, function ($q) {
                    $q->where('reservations.created_by', '=', auth()->user()->email);
                })
                ->orderBy('reservations.kode_sewa', 'desc') // Pengurutan berdasarkan kode_sewa
                ->paginate(10);
            return view('website.status._data-sewa', compact('sewa'))->render();
        }

        return view('website.status.index', compact('sewa', 'report', 'repair'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status_calendar(Request $request)
    {
        $data = Reservation::select(
            'reservations.id',
            DB::raw("concat(layanans.name, ' - ', reservations.unit) as title"),
            'reservations.kode_sewa',
            'reservations.start_date as start',
            'reservations.end_date as end',
            'reservations.fee_for',
            'reservations.catatan',
            'reservations.unit',
            'reservations.description',
            'reservations.status',
            'layanans.name as layanan',
            'layanans.address',
            'layanans.location',
            'layanans.price_for',
            'layanans.type',
            'users.first_name',
            'users.last_name',
            'users.itb_unit',
        )
            ->join('layanans', 'layanans.id', '=', 'reservations.layanan_id')
            ->join('users', 'users.email', '=', 'reservations.created_by')
            ->whereNotIn('reservations.status', ['EXPIRED', 'DITOLAK', 'DIBATALKAN'])
            // ->whereDate('start_date', '>=', $request->start)
            // ->whereDate('end_date',   '<=', $request->end)
            ->when($request->type, function ($q) use ($request) {
                $q->where('layanans.type', $request->type);
            })
            ->when($request->loc, function ($q) use ($request) {
                $q->where('layanans.location', $request->loc);
            })
            ->when($request->unit, function ($q) use ($request) {
                $q->where('reservations.unit', $request->unit);
            })
            ->when($request->search != null, function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('layanans.name', 'like', '%' . $request->search . '%')
                        ->orWhere('layanans.location', 'like', '%' . $request->search . '%')
                        ->orWhere('reservations.kode_sewa', 'like', '%' . $request->search . '%')
                        ->orWhere('reservations.unit', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->only_me != null, function ($q) {
                $q->where('reservations.created_by', '=', auth()->user()->email);
            })
            ->get();

        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status_report(Request $request)
    {
        if ($request->ajax()) {
            // Reservation::;
            $report = ReportService::select(
                'report_services.*',
                'users.first_name',
                'users.last_name',
                'users.email'
            )
                ->join('users', 'users.email', '=', 'report_services.created_by')
                // ->whereNotIn('reservations.status', ['EXPIRED', 'DITOLAK', 'DIBATALKAN'])
                ->when($request->type, function ($q) use ($request) {
                    $q->where('report_services.jenis', $request->type);
                })
                ->when($request->search != null, function ($q) use ($request) {
                    $q->where('report_services.keterangan', 'like', '%' . $request->search . '%');
                })
                ->when($request->only_me != null, function ($q) {
                    $q->where('report_services.created_by', '=', auth()->user()->email);
                })
                ->paginate(10);
            return view('website.status._data-report', compact('report'))->render();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status_report_calendar(Request $request)
    {
        $data = ReportService::select(
            'report_services.id',
            DB::raw("concat(report_services.keterangan, ' ', users.first_name) as title"),
            'report_services.created_at as start',
            'report_services.created_at as end',
            'report_services.jenis',
            'report_services.status'
        )
            ->join('users', 'users.email', '=', 'report_services.created_by')
            // ->whereNotIn('reservations.status', ['EXPIRED', 'DITOLAK', 'DIBATALKAN'])
            ->whereDate('report_services.created_at', '>=', $request->start)
            ->whereDate('report_services.created_at',   '<=', $request->end)
            ->when($request->type, function ($q) use ($request) {
                $q->where('report_services.jenis', $request->type);
            })
            ->when($request->search != null, function ($q) use ($request) {
                $q->where('report_services.keterangan', 'like', '%' . $request->search . '%');
            })
            ->when($request->only_me != null, function ($q) {
                $q->where('report_services.created_by', '=', auth()->user()->email);
            })
            ->get();

        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status_repair(Request $request)
    {
        if ($request->ajax()) {
            $repair = RepairService::select(
                'repair_services.*',
                'users.first_name',
                'users.last_name',
                'users.email'
            )
                ->join('users', 'users.email', '=', 'repair_services.created_by')
                ->when($request->search != null, function ($q) use ($request) {
                    $q->where('repair_services.title', 'like', '%' . $request->search . '%');
                })
                ->when($request->only_me != null, function ($q) {
                    $q->where('repair_services.created_by', '=', auth()->user()->email);
                })
                ->paginate(10);
            return view('website.status._data-repair', compact('repair'))->render();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status_repair_calendar(Request $request)
    {
        $data = RepairService::select(
            'repair_services.id',
            'repair_services.title',
            'repair_services.created_at as start',
            'repair_services.created_at as end',
            'repair_services.status'
        )
            ->join('users', 'users.email', '=', 'repair_services.created_by')
            ->whereNotIn('repair_services.status', ['Draft'])
            ->whereDate('repair_services.created_at', '>=', $request->start)
            ->whereDate('repair_services.created_at',   '<=', $request->end)
            ->when($request->search != null, function ($q) use ($request) {
                $q->where('repair_services.title', 'like', '%' . $request->search . '%');
            })
            ->when($request->only_me != null, function ($q) {
                $q->where('repair_services.created_by', '=', auth()->user()->email);
            })
            ->get();

        return response()->json($data);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_room(Layanan $layanan)
    {
        $layanan_gambars = $layanan->layanan_gambars()->get();
        $service_facilities = $layanan->service_facilities()->with('facility')->get();

        $layananModel = new Layanan;
        $other_rooms = $layananModel->get_other_data('RUANG', 6, $layanan->id);

        return view('website.rooms.details', [
            'data' => $layanan,
            'room_pictures' => $layanan_gambars,
            'service_facilities' => $service_facilities,
            'other_rooms' => $other_rooms,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_car(Layanan $layanan)
    {
        $layanan_gambars = $layanan->layanan_gambars()->get();
        $service_facilities = $layanan->service_facilities()->with('facility')->get();

        $layananModel = new Layanan;
        $other_cars = $layananModel->get_other_data('KENDARAAN', 6, $layanan->id);

        return view('website.cars.details', [
            'data' => $layanan,
            'car_pictures' => $layanan_gambars,
            'service_facilities' => $service_facilities,
            'other_cars' => $other_cars,
        ]);
    }

    public function show_rku(Layanan $layanan)
    {
        $layanan_gambars = $layanan->layanan_gambars()->get();
        $service_facilities = $layanan->service_facilities()->with('facility')->get();

        $layananModel = new Layanan;
        $other_rku = $layananModel->get_other_data('RKU', 6, $layanan->id);

        return view('website.rku.details', [
            'data' => $layanan,
            'rku_pictures' => $layanan_gambars,
            'service_facilities' => $service_facilities,
            'other_rku' => $other_rku,
        ]);
    }

    public function show_rumah(Layanan $layanan)
    {
        $layanan_gambars = $layanan->layanan_gambars()->get();
        $service_facilities = $layanan->service_facilities()->with('facility')->get();

        $layananModel = new Layanan;
        $other_rumah = $layananModel->get_other_data('RUMAH SUSUN', 6, $layanan->id);

        return view('website.rumah.details', [
            'data' => $layanan,
            'rumah_pictures' => $layanan_gambars,
            'service_facilities' => $service_facilities,
            'other_rumah' => $other_rumah,
        ]);
    }

    public function show_selasar(Layanan $layanan)
    {
        $layanan_gambars = $layanan->layanan_gambars()->get();
        $service_facilities = $layanan->service_facilities()->with('facility')->get();

        $layananModel = new Layanan;
        $other_selasar = $layananModel->get_other_data('SELASAR', 6, $layanan->id);

        return view('website.selasar.details', [
            'data' => $layanan,
            'selasar_pictures' => $layanan_gambars,
            'service_facilities' => $service_facilities,
            'other_selasar' => $other_selasar,
        ]);
    }

    public function show_lapangan(Layanan $layanan)
    {
        $layanan_gambars = $layanan->layanan_gambars()->get();
        $service_facilities = $layanan->service_facilities()->with('facility')->get();

        $layananModel = new Layanan;
        $other_lapangan = $layananModel->get_other_data('LAPANGAN', 6, $layanan->id);

        return view('website.lapangan.details', [
            'data' => $layanan,
            'lapangan_pictures' => $layanan_gambars,
            'service_facilities' => $service_facilities,
            'other_lapangan' => $other_lapangan,
        ]);
    }

    public function show_peralatan(Layanan $layanan)
    {
        $layanan_gambars = $layanan->layanan_gambars()->get();
        $service_facilities = $layanan->service_facilities()->with('facility')->get();

        $layananModel = new Layanan;
        $other_peralatan = $layananModel->get_other_data('PERALATAN', 6, $layanan->id);

        return view('website.peralatan.details', [
            'data' => $layanan,
            'peralatan_pictures' => $layanan_gambars,
            'service_facilities' => $service_facilities,
            'other_peralatan' => $other_peralatan,
        ]);
    }

    public function facilities(Request $request)
    {
        $search = $request->search;
        $dataId = $request->data_id;

        $facilities = ServiceFacility::select(
            "facilities.id",
            "facilities.name",
            "service_facilities.fee",
            "service_facilities.quantity",
            "facilities.satuan",
            DB::raw("concat(facilities.name, ' - Rp. ', convert(format(service_facilities.fee, 0), Char), ' / ', service_facilities.quantity, ' ', facilities.satuan) as text")
        )
            ->join('facilities', "facilities.id", "=", "service_facilities.facility_id")
            ->where('facilities.status', 'AKTIF')
            ->where("service_facilities.type", "Tambahan")
            ->where('service_facilities.layanan_id', "=", $dataId)
            ->when($search != '', function ($q) use ($search) {
                $q->where('facilities.name', 'like', '%' . $search . '%');
            })
            ->orderby('facilities.name', 'asc')
            ->limit(20)->get();


        $response = array();
        foreach ($facilities as $facility) {
            $response[] = array(
                "id" => $facility->id,
                "text" => $facility->text,
                "name" => $facility->name,
                "fee" => $facility->fee,
                "fee_for" => $facility->quantity,
                "satuan" => $facility->satuan
            );
        }
        return response()->json($response);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        return view('website.report.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function repair()
    {
        return view('website.repair.create');
    }

    public function buildings(Request $request)
    {
        $search = $request->search;

        $buildings = Building::where('buildings.status', 'AKTIF')
            ->when($search != '', function ($q) use ($search) {
                $q->where('buildings.name', 'like', '%' . $search . '%');
            })
            ->orderby('buildings.name', 'asc')
            ->limit(20)->get();

        $response = array();
        foreach ($buildings as $building) {
            $response[] = array(
                "id" => $building->id,
                "text" => $building->name,
            );
        }
        return response()->json($response);
    }

    public function floors(Request $request)
    {
        $search = $request->search;
        $building_id = $request->building_id;

        $floors = Floor::where('floors.building_id', $building_id)
            ->when($search != '', function ($q) use ($search) {
                $q->where('floors.floor_classification', 'like', '%' . $search . '%')
                    ->orWhere('floors.room_classification', 'like', '%' . $search . '%')
                    ->orWhere('floors.kategori_ruangan', 'like', '%' . $search . '%')
                    ->orWhere('floors.room_description', 'like', '%' . $search . '%');
            })
            ->orderby('floors.floor_classification', 'asc')
            ->limit(20)->get();

        $response = array();
        foreach ($floors as $floor) {
            $response[] = array(
                "id" => $floor->id,
                "text" => "Lantai " . $floor->number . " - " . $floor->floor_classification . " " . $floor->room_classification . " " . $floor->kategori_ruangan . " " . $floor->room_description,
                "number" => $floor->number,
                "unit_itb" => $floor->unit_itb,
                "floor_classification" => $floor->floor_classification,
                "room_classification" => $floor->room_classification,
                "kategori_ruangan" => $floor->kategori_ruangan,
                "room_description" => $floor->room_description,
            );
        }
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function about(Request $request)
    {
        return view('website.about.index');
    }

    public function lab(Request $request)
    {
        return view('website.lab.index');
    }
}
