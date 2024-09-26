<?php

namespace App\Http\Controllers;

use App\DataTables\FloorBuildingDataTable;
use App\DataTables\FloorDataTable;
use App\Models\Floor;
use App\Http\Requests\StoreFloorRequest;
use App\Http\Requests\UpdateFloorRequest;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Building;
use App\Exports\ExportDataLuas;
use App\Exports\ExportKategoriRuangan;
use App\Exports\ExportKategoriUnit;
use DB;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FloorDataTable $dataTable, Building $building)
    {
        $this->authorize("read floor");
        return $dataTable
            ->with("building_id", $building->id)
            ->render(
                "pages.floor.index",
                ["building" => $building]
            );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function building(FloorBuildingDataTable $dataTable)
    {
        $this->authorize("read floor");
        return $dataTable->render("pages.floor.building");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Building $building)
    // {
    //     $this->authorize("create floor");
    //     return view('pages.floor.create', compact("building"));
    // }

    // edited 280324
    public function create(Floor $floor)
    {
        $this->authorize("create floor");
        $buildings = Building::orderBy('name')->get(); 
        return view('pages.floor.create', compact("floor", "buildings"));
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFloorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFloorRequest $request)
    {
        $this->authorize("create floor");
        DB::beginTransaction();
        try {
            $validated = $request->validate($request->rules());
            $validated['status'] = "AKTIF";
            $validated['created_by'] = auth()->user()->email;

            // create floor
            Floor::create($validated);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function edit(Floor $floor)
    {
        $this->authorize("update floor");
        $buildings = Building::orderBy('name')->get(); 
        return view('pages.floor.edit', compact("floor", "buildings"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFloorRequest  $request
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFloorRequest $request, Floor $floor)
    {
        $this->authorize("update floor");
        DB::beginTransaction();
        try {
            $validated = $request->validate($request->rules());
            $validated['updated_by'] = auth()->user()->email;

            // update floor
            $floor->update($validated);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Floor $floor)
    {
        $this->authorize("delete floor");
        DB::beginTransaction();
        try {
            // check if facility is used
            // $is_used = ServiceFacility::where('facility_id', $facility->id)->count();
            // if ($is_used > 0) {
            //     throw new \Exception('Gagal Hapus, Saat ini fasilitas sedang digunakan di Layanan.');
            // }

            // update data to deleted
            $validated['status'] = "DIHAPUS";
            $validated['deleted_at'] = date('Y-m-d H:i:s');
            $validated['deleted_by'] = auth()->user()->email;

            // update floor
            $floor->update($validated);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function ExportDataLuas()
    {
        // Cek apakah pengguna telah terautentikasi
        if (Auth::check()) {
            // Ambil data pengguna yang terautentikasi
            $user = Auth::user();
            
            // Pastikan pengguna memiliki kolom itb_unit
            if ($user->itb_unit) {
                // Ambil semua lantai (floors)
                $floors = Floor::where('status', 'AKTIF')->orderBy('unit_itb')->get();
                
                // Gunakan class export Excel (ExportDataLuas) untuk menyimpan data ke dalam file Excel
                return Excel::download(new ExportDataLuas($floors), 'Data_Luas_' . $user->itb_unit . '.xlsx');
            } else {
                // Jika kolom itb_unit pengguna kosong, beri tanggapan sesuai kebutuhan aplikasi Anda
                return response()->json(['error' => 'Kolom itb_unit pengguna tidak ditemukan.']);
            }
        } else {
            // Jika pengguna tidak terautentikasi, arahkan ke halaman login atau beri tanggapan sesuai kebutuhan aplikasi Anda
            return redirect()->route('login');
        }
    }

    public function admin_status()
    {
        $floors = DB::table('floors as f')
            ->select('f.unit_itb', DB::raw('IFNULL(q1.large, 0) AS sudah_kategori'), DB::raw('IFNULL(q2.large, 0) AS belum_kategori'))
            ->leftJoin(DB::raw('(SELECT unit_itb, SUM(large) AS large FROM floors WHERE kategori_ruangan NOT IN ("-") AND deleted_at IS NULL AND status = "AKTIF" GROUP BY unit_itb) q1'), 'q1.unit_itb', '=', 'f.unit_itb')
            ->leftJoin(DB::raw('(SELECT unit_itb, SUM(large) AS large FROM floors WHERE kategori_ruangan IN ("-") AND deleted_at IS NULL AND status = "AKTIF" GROUP BY unit_itb) q2'), 'q2.unit_itb', '=', 'f.unit_itb')
            ->where('f.deleted_at', NULL)
            ->where('f.status', 'AKTIF')
            ->groupBy('f.unit_itb', 'q1.large', 'q2.large') // Memasukkan kolom agregat dalam GROUP BY
            ->orderBy('f.unit_itb')
            ->get();
    
        return $floors;
    }

    public function getFloorsData()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mendapatkan data floors sesuai dengan unit_itb dari user yang sedang login
        $floorsData = DB::table('floors')
                        ->selectRaw("CASE WHEN kategori_ruangan IN ('-') THEN 'Belum Kategori' ELSE kategori_ruangan END AS kategori_ruangan")
                        ->selectRaw("COUNT(kategori_ruangan) AS jumlah, SUM(large) AS luas")
                        ->where('deleted_at', null)
                        ->where('status', 'AKTIF')
                        ->where('unit_itb', $user->itb_unit)
                        ->groupBy('kategori_ruangan')
                        ->get();

        return $floorsData;
    }

    public function KategoriUnitExcel()
    {
        $floors = $this->admin_status();

        return Excel::download(new ExportKategoriUnit($floors), 'kategori-unit.xlsx');
    }

    public function getFloorDetail($unit)
    {
        $getFloorDetail = DB::table('floors')
                        ->selectRaw("CASE WHEN kategori_ruangan IN ('-') THEN 'Belum Kategori' ELSE kategori_ruangan END AS kategori_ruangan")
                        ->selectRaw("COUNT(kategori_ruangan) AS jumlah, SUM(large) AS luas")
                        ->where('deleted_at', null)
                        ->where('status', 'AKTIF')
                        ->where('unit_itb', $unit)
                        ->groupBy('kategori_ruangan')
                        ->get();

        return response()->json($getFloorDetail);
    }

    public function getFloorsSudahKategori()
    {
        $floorsSudahKategoriData = DB::table('floors as f')
            ->select(DB::raw("CASE WHEN f.kategori_ruangan = '-' THEN 'Belum Kategori' ELSE f.kategori_ruangan END AS kategori_ruangan, COUNT(f.kategori_ruangan) AS jumlah, SUM(f.large) AS luas"))
            ->whereNull('f.deleted_at')
            ->where('f.status', 'AKTIF')
            ->groupBy('f.kategori_ruangan')
            ->orderBy(DB::raw("CASE WHEN f.kategori_ruangan = '-' THEN 'Belum Kategori' ELSE f.kategori_ruangan END"))
            ->get();

        return $floorsSudahKategoriData;
    }

    public function KategoriRuanganExcel()
    {
        $floorsSudahKategoriData = $this->getFloorsSudahKategori();

        return Excel::download(new ExportKategoriRuangan($floorsSudahKategoriData), 'kategori-ruangan.xlsx');
    }

    public function getSudahKategoriDetail($kategori_ruang)
    {
        $getSudahKategoriDetail = DB::table('floors as f')
                        ->selectRaw("f.unit_itb")
                        ->selectRaw("COUNT(f.kategori_ruangan) AS jumlah")
                        ->selectRaw("SUM(f.large) AS luas")
                        ->where('f.deleted_at', null)
                        ->where('f.status', 'AKTIF')
                        ->where('f.kategori_ruangan', $kategori_ruang)
                        ->groupBy('f.unit_itb')
                        ->orderBy('f.unit_itb')
                        ->get();

        return response()->json($getSudahKategoriDetail);
    }

}
