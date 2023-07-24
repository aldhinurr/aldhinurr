<?php

namespace App\Http\Controllers;

use App\Models\ReportService;
use App\Http\Requests\StoreReportServiceRequest;
use App\Http\Requests\UpdateReportServiceRequest;
use App\Models\ReportServiceImage;
use DateTime;
use DateTimeZone;
use DB;
use Str;

class ReportServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreReportServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReportServiceRequest $request)
    {
        DB::beginTransaction();
        try {
            $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $validated = $request->validate($request->rules());
            $validated['jenis'] = "PERBAIKAN CEPAT";
            $validated['status'] = "MENUNGGU";
            $validated['created_by'] = "customer@email.com";
            $validated['created_at'] = $now;

            // create report
            $report_service = ReportService::create($validated);

            if ($report_service) {
                // upload dan simpan gambar report
                foreach ($validated['files'] as $img => $image) {
                    // do upload and save to db
                    $imageName = time() . strtolower(Str::random(10)) . '.' . $image->extension();
                    $image->move(public_path('media/images/report'), $imageName);

                    ReportServiceImage::create([
                        'report_service_id' => $report_service->id,
                        'image' => 'media/images/report/' . $imageName,
                        'status' => 'SEBELUM',
                        'created_by' => "customer@email.com",
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Laporan berhasil dibuat",
                'report_service_id' => $report_service->id
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
     * @param  \App\Models\ReportService  $reportService
     * @return \Illuminate\Http\Response
     */
    public function show(ReportService $reportService)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportService  $reportService
     * @return \Illuminate\Http\Response
     */
    public function detail(ReportService $reportService)
    {
        $reportServiceImagesBefore = ReportServiceImage::whereBelongsTo($reportService)->where('status', 'SEBELUM')->get();
        $reportServiceImagesAfter = ReportServiceImage::whereBelongsTo($reportService)->where('status', 'SESUDAH')->get();

        return view('website.report.detail', [
            'reportService' => $reportService,
            'reportServiceImagesBefore' => $reportServiceImagesBefore,
            'reportServiceImagesAfter' => $reportServiceImagesAfter,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportService  $reportService
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportService $reportService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReportServiceRequest  $request
     * @param  \App\Models\ReportService  $reportService
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReportServiceRequest $request, ReportService $reportService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportService  $reportService
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportService $reportService)
    {
        //
    }
}
