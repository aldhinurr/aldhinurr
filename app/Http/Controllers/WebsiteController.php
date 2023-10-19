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

        // Kendaraan
        $count_cars = $layanan->get_count_data('KENDARAAN');
        $cars = $layanan->get_home_data('KENDARAAN', 6);

        // Ruangan
        $count_selasar = $layanan->get_count_data('SELASAR');
        $selasar = $layanan->get_home_data('SELASAR', 6);

        // Lapangan
        $count_lapangan = $layanan->get_count_data('LAPANGAN');
        $lapangan = $layanan->get_home_data('LAPANGAN', 6);

        // Laporan
        $report_done = $report->get_count_data(['SELESAI']);
        $report_waiting = $report->get_count_data(['MENUNGGU']);
        $report_process = $report->get_count_data(['SEDANG DIKERJAKAN', 'SEDANG DIPERIKSA']);


        return view('website.index', [
            'count_rooms' => $count_rooms,
            'count_cars' => $count_cars,
            'count_selasar' => $count_selasar,
            'count_lapangan' => $count_lapangan,
            'report_done' => $report_done,
            'report_waiting' => $report_waiting,
            'report_process' => $report_process,
            'rooms' => $rooms,
            'cars' => $cars,
            'selasar' => $selasar,
            'lapangan' => $lapangan,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rooms(Request $request)
    {
        $layanan = new Layanan;
        $rooms = $layanan->get_page_data('RUANG', 18, $request);

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
            $rooms = $layanan->get_page_data('RUANG', 18, $request);
            $view = view('website.rooms._data', compact('rooms', 'is_sewa'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website.rooms.index', compact('rooms', 'is_sewa'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rooms_untukdiweb(Request $request)
    {
        $layanan = new Layanan;
        $rooms = $layanan->get_page_data('RUANG', 18, $request);

        // is_sewa
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $addThreedays = $now->add(DateInterval::createFromDateString('3 days'));
        $dateSewa = $addThreedays->format('Y-m-d');
        if ($request->start_date) {
            $start_date = strtotime(str_replace("/", "-", $request->start_date));
            $dateSewa = date('Y-m-d', $start_date);
        }

        $sewa = Reservation::select('layanan_id')
            ->join('layanans', 'reservations.layanan_id', '=', 'layanans.id')
            ->whereNotIn('reservations.status', ['DITOLAK', 'DIBATALKAN', 'DIALIHKAN', 'SELESAI'])
            ->where('reservations.start_date', '<=', $dateSewa . ' 23:59')
            ->where('reservations.end_date', '>=', $dateSewa . ' 00:01')
            ->where('layanans.location', '=', 'GANESHA')
            ->get();

        $is_sewa = array();
        if (count($sewa) > 0) {
            foreach ($sewa as $s => $val) {
                array_push($is_sewa, $val->layanan_id);
            }
        }

        if ($request->ajax()) {
            $rooms = $layanan->get_page_data('RUANG', 18, $request);
            $view = view('website.rooms._data_untukdiweb', compact('rooms', 'is_sewa'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website.rooms.index_untukdiweb', compact('rooms', 'is_sewa'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cars(Request $request)
    {
        $layanan = new Layanan;
        $cars = $layanan->get_page_data('KENDARAAN', 18, $request);

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
            $cars = $layanan->get_page_data('KENDARAAN', 18, $request);
            $view = view('website.cars._data', compact('cars', 'is_sewa'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website.cars.index', compact('cars', 'is_sewa'));
    }

    public function selasar(Request $request)
    {
        $layanan = new Layanan;
        $selasar = $layanan->get_page_data('SELASAR', 18, $request);

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
            $selasar = $layanan->get_page_data('SELASAR', 18, $request);
            $view = view('website.selasar._data', compact('selasar', 'is_sewa'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website.selasar.index', compact('selasar', 'is_sewa'));
    }

    public function lapangan(Request $request)
    {
        $layanan = new Layanan;
        $lapangan = $layanan->get_page_data('LAPANGAN', 18, $request);

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
            $lapangan = $layanan->get_page_data('LAPANGAN', 18, $request);
            $view = view('website.lapangan._data', compact('lapangan', 'is_sewa'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website.lapangan.index', compact('lapangan', 'is_sewa'));
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
                    $q->where('layanans.name', 'like', '%' . $request->search . '%');
                })
                ->when($request->only_me != null, function ($q) {
                    $q->where('reservations.created_by', '=', auth()->user()->email);
                })
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
            DB::raw("concat(layanans.name, ' - ', users.itb_unit) as title"),
            'reservations.kode_sewa',
            'reservations.start_date as start',
            'reservations.end_date as end',
            'reservations.fee_for',
            'reservations.catatan',
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
            ->whereDate('start_date', '>=', $request->start)
            ->whereDate('end_date',   '<=', $request->end)
            ->when($request->type, function ($q) use ($request) {
                $q->where('layanans.type', $request->type);
            })
            ->when($request->search != null, function ($q) use ($request) {
                $q->where('layanans.name', 'like', '%' . $request->search . '%');
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
                    ->orWhere('floors.room_description', 'like', '%' . $search . '%');
            })
            ->orderby('floors.floor_classification', 'asc')
            ->limit(20)->get();

        $response = array();
        foreach ($floors as $floor) {
            $response[] = array(
                "id" => $floor->id,
                "text" => "Lantai " . $floor->number . " - " . $floor->floor_classification . " " . $floor->room_classification . " " . $floor->room_description,
                "number" => $floor->number,
                "floor_classification" => $floor->floor_classification,
                "room_classification" => $floor->room_classification,
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
}
