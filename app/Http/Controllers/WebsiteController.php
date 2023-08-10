<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Layanan;
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

        // Laporan
        $count_reports = $report->get_count_data('SELESAI');


        return view('website.index', [
            'count_rooms' => $count_rooms,
            'count_cars' => $count_cars,
            'count_reports' => $count_reports,
            'rooms' => $rooms,
            'cars' => $cars,
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
            ->where('end_date', '>=', $dateSewa)
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
    public function status(Request $request)
    {
        $sewa = Reservation::with(["layanan", "user"])->paginate(10);
        $report = ReportService::with(["report_service_images", "user"])->paginate(10);
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

        return view('website.status.index', compact('sewa', 'report'));
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
            DB::raw("concat(layanans.name, ' ', users.first_name) as title"),
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
