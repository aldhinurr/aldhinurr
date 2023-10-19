<?php

namespace App\Http\Controllers;

use App\DataTables\RepairServiceDataTable;
use App\Models\RepairService;
use App\Http\Requests\StoreRepairServiceRequest;
use App\Http\Requests\UpdateRepairServiceRequest;
use App\Models\RepairServiceDetail;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use DB;
use Str;

class RepairServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RepairServiceDataTable $dataTable)
    {
        $this->authorize("read repair_service");
        return $dataTable->render("pages.repair.index");
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
     * @param  \App\Http\Requests\StoreRepairServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRepairServiceRequest $request)
    {
        DB::beginTransaction();
        try {
            $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $now->format('Y-m-d H:i:s');

            $validated = $request->validate($request->rules());
            $validated['created_at'] = $now;
            $validated['created_by'] = auth()->user()->email;

            // create layanan
            $repair = RepairService::create($validated);
            if ($repair) {
                // save detail repair
                $pengajuan_detail = json_decode($validated['pengajuan_detail']);
                foreach ($pengajuan_detail as $floor_id => $detail) {
                    foreach ($detail->data as $key => $value) {
                        $validated_detail = [
                            'repair_service_id' => $repair->id,
                            'floor_id' => $floor_id,
                            'name' => $value->name,
                            'cost' => $value->cost,
                        ];
                        RepairServiceDetail::create($validated_detail);
                    }
                }

                // upload attachment
                if ($request->attachment) {
                    $attachment = $request->attachment;
                    $fileName = $repair->id . "-" . strtolower(Str::random(10)) . '.' . $attachment->extension();
                    $attachment->move(public_path('media/upload/repair'), $fileName);

                    $validated['attachment'] = 'media/upload/repair/' . $fileName;
                    $repair->update($validated);
                }
            }

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Pengajuan perbaikan berhasil dibuat",
                'repair_id' => $repair->id
            ], 201);
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
     * @param  \App\Models\RepairService  $repairService
     * @return \Illuminate\Http\Response
     */
    public function show(RepairService $repairService)
    {
        $this->authorize("read repair_service");

        $repairServiceDetails = array();
        $repairDetails = RepairServiceDetail::whereBelongsTo($repairService)->get();

        // header detail
        foreach ($repairDetails as $key => $value) {

            $floor['building'] = $value->floor->building->name;
            $floor['floor'] = $value->floor->number;
            $floor['classification'] = $value->floor->floor_classification . " " . $value->floor->room_classification;
            $floor['description'] = $value->floor->room_description;
            $floor['total'] = 0;
            $floor['data'] = array();
            $repairServiceDetails[$value->floor->id] = $floor;
        }

        // list detail
        foreach ($repairDetails as $key => $value) {
            $detail['name'] = $value->name;
            $detail['cost'] = $value->cost;
            $repairServiceDetails[$value->floor->id]["data"][] = $detail;
            $repairServiceDetails[$value->floor->id]["total"] += $value->cost;
        }

        return view('pages.repair.details', [
            'repairService' => $repairService,
            'repairServiceDetails' => $repairServiceDetails
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RepairService  $repairService
     * @return \Illuminate\Http\Response
     */
    public function detail(RepairService $repairService)
    {
        $repairServiceDetails = array();
        $repairDetails = RepairServiceDetail::whereBelongsTo($repairService)->get();

        // header detail
        foreach ($repairDetails as $key => $value) {
            $floor['building'] = $value->floor->building->name;
            $floor['floor'] = $value->floor->number;
            $floor['classification'] = $value->floor->floor_classification . " " . $value->floor->room_classification;
            $floor['description'] = $value->floor->room_description;
            $floor['total'] = 0;
            $floor['data'] = array();
            $repairServiceDetails[$value->floor->id] = $floor;
        }

        // list detail
        foreach ($repairDetails as $key => $value) {
            $detail['name'] = $value->name;
            $detail['cost'] = $value->cost;
            $repairServiceDetails[$value->floor->id]["data"][] = $detail;
            $repairServiceDetails[$value->floor->id]["total"] += $value->cost;
        }

        return view('website.repair.detail', [
            'repairService' => $repairService,
            'repairServiceDetails' => $repairServiceDetails
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RepairService  $repairService
     * @return \Illuminate\Http\Response
     */
    public function edit(RepairService $repairService)
    {
        $repairServiceDetails = array();
        $repairDetails = RepairServiceDetail::whereBelongsTo($repairService)->get();

        // header detail
        foreach ($repairDetails as $key => $value) {
            $floor['building_id'] = $value->floor->building_id;
            $floor['building'] = $value->floor->building->name;
            $floor['floor'] = $value->floor->number;
            $floor['classification'] = $value->floor->floor_classification . " " . $value->floor->room_classification;
            $floor['description'] = $value->floor->room_description;
            $floor['total'] = 0;
            $floor['data'] = array();
            $repairServiceDetails[$value->floor->id] = $floor;
        }

        // list detail
        foreach ($repairDetails as $key => $value) {
            $detail['name'] = $value->name;
            $detail['cost'] = $value->cost;
            $repairServiceDetails[$value->floor->id]["data"][] = $detail;
            $repairServiceDetails[$value->floor->id]["total"] += $value->cost;
        }

        return view('website.repair.edit', [
            'repairService' => $repairService,
            'repairServiceDetails' => $repairServiceDetails
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRepairServiceRequest  $request
     * @param  \App\Models\RepairService  $repairService
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRepairServiceRequest $request, RepairService $repairService)
    {

        DB::beginTransaction();
        try {
            $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $now->format('Y-m-d H:i:s');

            $validated = $request->validate($request->rules());
            $validated['created_at'] = $now;
            $validated['created_by'] = auth()->user()->email;
            $validated['updated_at'] = $now;
            $validated['updated_by'] = auth()->user()->email;

            // update data repair
            $repair = $repairService->update($validated);
            if ($repair) {
                // delete old detail
                RepairServiceDetail::whereBelongsTo($repairService)->delete();

                // save new detail
                $pengajuan_detail = json_decode($validated['pengajuan_detail']);
                foreach ($pengajuan_detail as $floor_id => $detail) {
                    foreach ($detail->data as $key => $value) {
                        $validated_detail = [
                            'repair_service_id' => $repairService->id,
                            'floor_id' => $floor_id,
                            'name' => $value->name,
                            'cost' => $value->cost,
                        ];
                        RepairServiceDetail::create($validated_detail);
                    }
                }

                // upload attachment
                if ($request->attachment) {
                    $attachment = $request->attachment;
                    $fileName = $repairService->id . "-" . strtolower(Str::random(10)) . '.' . $attachment->extension();
                    $attachment->move(public_path('media/upload/repair'), $fileName);

                    $validated['attachment'] = 'media/upload/repair/' . $fileName;
                    $repairService->update($validated);

                    // delete oldfile from server
                    $path = public_path() . $repairService->attachment;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Pengajuan perbaikan berhasil diupdate",
                'repair_id' => $repairService->id
            ], 200);
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
     * @param  \App\Models\RepairService  $repairService
     * @return \Illuminate\Http\Response
     */
    public function destroy(RepairService $repairService)
    {
        //
    }

    public function approve(Request $request, RepairService $repairService)
    {
        Db::beginTransaction();
        try {
            $validated = $request->validate([
                'description' => "required|string|max:200"
            ]);

            $validated['status'] = "Setuju";
            $validated['processed_by'] = auth()->user()->email;
            $validated['processed_at'] = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $repairService->update($validated);

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Pengajuan Berhasil Disetujui."
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 1,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function reject(Request $request, RepairService $repairService)
    {
        Db::beginTransaction();
        try {
            $validated = $request->validate([
                'description' => "required|string|max:200"
            ]);

            $validated['status'] = "Ditolak";
            $validated['processed_by'] = auth()->user()->email;
            $validated['processed_at'] = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $repairService->update($validated);

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Pengajuan Berhasil Ditolak."
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 1,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function review(Request $request, RepairService $repairService)
    {
        Db::beginTransaction();
        try {
            $validated = $request->validate([
                'description' => "required|string|max:200"
            ]);

            $validated['status'] = "Sedang Direview";
            $validated['processed_by'] = auth()->user()->email;
            $validated['processed_at'] = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $repairService->update($validated);

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Pengajuan Berhasil Direview."
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 1,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
