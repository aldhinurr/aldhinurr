<?php

namespace App\Http\Controllers;

use App\DataTables\FacilityDataTable;
use App\Models\Facility;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Models\ServiceFacility;
use DB;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:read facility");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FacilityDataTable $dataTable)
    {
        $this->authorize("read facility");
        return $dataTable->render("pages.facility.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create facility");

        // load icons
        foreach (scandir(resource_path('assets/core/media/icons/lineawesome')) as $key => $icon) {
            if (!in_array($icon, [".", ".."])) {
                $obj['name'] = str_replace('-solid', '', explode(".", $icon)[0]);
                $obj['icon'] = 'demo1/media/icons/lineawesome/' . $icon;
                $icons[] = $obj;
            }
        }

        return view('pages.facility.create', ['icons' => $icons]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFacilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacilityRequest $request)
    {
        $this->authorize("create layanan");

        DB::beginTransaction();
        try {
            $validated = $request->validate($request->rules());
            $validated['created_by'] = auth()->user()->email;

            // create layanan
            Facility::create($validated);

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
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        $this->authorize("read facility");
        return view('pages.facility.details', [
            'facility' => $facility
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Facility $facility)
    {
        $this->authorize("update facility");

        // load icons
        foreach (scandir(resource_path('assets/core/media/icons/lineawesome')) as $key => $icon) {
            if (!in_array($icon, [".", ".."])) {
                $obj['name'] = str_replace('-solid', '', explode(".", $icon)[0]);
                $obj['icon'] = 'demo1/media/icons/lineawesome/' . $icon;
                $icons[] = $obj;
            }
        }
        return view('pages.facility.edit', [
            'facility' => $facility,
            'icons' => $icons,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFacilityRequest  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacilityRequest $request, Facility $facility)
    {
        $this->authorize("update layanan");

        DB::beginTransaction();
        try {
            $validated = $request->validate($request->rules());
            $validated['updated_by'] = auth()->user()->email;

            // update facility
            $facility->update($validated);

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
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        DB::beginTransaction();
        try {
            // check if facility is used
            $is_used = ServiceFacility::where('facility_id', $facility->id)->count();
            if ($is_used > 0) {
                throw new \Exception('Gagal Hapus, Saat ini fasilitas sedang digunakan di Layanan.');
            }

            // update data to deleted
            $validated['status'] = "DIHAPUS";
            $validated['deleted_at'] = date('Y-m-d H:i:s');
            $validated['deleted_by'] = auth()->user()->email;
            $facility->update($validated);

            // update facility
            $facility->update($validated);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getFacilities(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $facilities = Facility::orderby('name', 'asc')->select('id', 'name')->where('status', 'AKTIF')->limit(5)->get();
        } else {
            $facilities = Facility::orderby('name', 'asc')->select('id', 'name')->where('status', 'AKTIF')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($facilities as $facility) {
            $response[] = array(
                "id" => $facility->id,
                "text" => $facility->name
            );
        }
        return response()->json($response);
    }
}
