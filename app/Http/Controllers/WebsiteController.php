<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Layanan;
use App\Models\ReportService;
use App\Models\Reservation;
use DB;
use Illuminate\Http\Request;

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
        $rooms = $layanan->get_page_data('RUANG', 6, $request);

        if ($request->ajax()) {
            $rooms = $layanan->get_page_data('RUANG', 6, $request);
            $view = view('website.rooms._data', compact('rooms'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website.rooms.index', compact('rooms'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $sewa = Reservation::with("layanan")->paginate(1);
        if ($request->ajax()) {
            $sewa = Reservation::select('*')
                ->join('layanans', 'layanans.id', '=', 'reservations.layanan_id')
                ->when($request->type, function ($q) use ($request) {
                    $q->where('layanans.type', $request->type);
                })->paginate(1);
            return view('website.status._data', compact('sewa'))->render();
        }

        return view('website.status.index', compact('sewa'));
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
        $other_rooms = Layanan::with(['layanan_gambars'])
            ->where('type', 'RUANG')->where('status', 'AKTIF')
            ->inRandomOrder()->limit(5)->get();

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

        if ($search == '') {
            $facilities = Facility::select(
                "facilities.id",
                "facilities.name",
                "facilities.fee",
                "facilities.satuan",
                "facilities.fee_for",
                DB::raw("concat(facilities.name, ' - Rp. ', convert(format(facilities.fee, 0), Char), ' / ', facilities.fee_for, ' ', facilities.satuan) as text")
            )->whereNotIn('facilities.id', function ($query) use ($dataId) {
                $query->select('facilities.id')->from('facilities')
                    ->join('service_facilities', "facilities.id", "=", "service_facilities.facility_id")
                    ->where('facilities.status', 'AKTIF')
                    ->where('service_facilities.layanan_id', "=", $dataId);
            })
                ->where('facilities.status', 'AKTIF')
                ->orderby('facilities.name', 'asc')
                ->limit(20)->get();
        } else {
            $facilities = Facility::select(
                "facilities.id",
                "facilities.name",
                "facilities.fee",
                "facilities.satuan",
                "facilities.fee_for",
                DB::raw("concat(facilities.name, ' - Rp. ', convert(format(facilities.fee, 0), Char), ' / ', facilities.fee_for, ' ', facilities.satuan) as text")
            )->whereNotIn('facilities.id', function ($query) use ($dataId) {
                $query->select('facilities.id')->from('facilities')
                    ->join('service_facilities', "facilities.id", "=", "service_facilities.facility_id")
                    ->where('facilities.status', 'AKTIF')
                    ->where('service_facilities.layanan_id', "=", $dataId);
            })
                ->where('facilities.status', 'AKTIF')
                ->where('facilities.name', 'like', '%' . $search . '%')
                ->orderby('facilities.name', 'asc')
                ->limit(20)->get();
        }

        $response = array();
        foreach ($facilities as $facility) {
            $response[] = array(
                "id" => $facility->id,
                "text" => $facility->text,
                "name" => $facility->name,
                "fee" => $facility->fee,
                "fee_for" => $facility->fee_for,
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
