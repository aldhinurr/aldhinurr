<?php

namespace App\Http\Controllers;

use App\DataTables\FloorBuildingDataTable;
use App\DataTables\FloorDataTable;
use App\Models\Floor;
use App\Http\Requests\StoreFloorRequest;
use App\Http\Requests\UpdateFloorRequest;
use App\Models\Building;
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
    public function create(Building $building)
    {
        $this->authorize("create floor");
        return view('pages.floor.create', compact("building"));
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
        return view('pages.floor.edit', compact("floor"));
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
}
