<?php

namespace App\Http\Controllers;

use App\DataTables\ReportServiceDataTable;
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
    public function index(ReportServiceDataTable $dataTable)
    {
        return $dataTable->render("pages.report.index");
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
            $validated['status'] = "MENUNGGU";
            $validated['created_by'] = auth()->user()->email;
            $validated['created_at'] = $now;
            $validated['updated_by'] = auth()->user()->email;
            $validated['updated_at'] = $now;

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
                        'created_by' => auth()->user()->email,
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
        $reportServiceImagesBefore = ReportServiceImage::whereBelongsTo($reportService)->where('status', 'SEBELUM')->get();
        $reportServiceImagesAfter = ReportServiceImage::whereBelongsTo($reportService)->where('status', 'SESUDAH')->get();

        $oldImages = array();
        foreach ($reportServiceImagesAfter as $image) {
            $file_path = $image['image'];
            $dir_file = explode("/", $file_path);

            $obj['name'] = end($dir_file);
            $obj['size'] = filesize($file_path);
            $obj['path'] = url($file_path);

            array_push($oldImages, $obj);
        }

        return view('pages.report.details', [
            'report' => $reportService,
            'imagesBefore' => $reportServiceImagesBefore,
            'imagesAfter' => $reportServiceImagesAfter,
            'oldImages' => $oldImages,
        ]);
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
        DB::beginTransaction();
        try {
            $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

            $validated = $request->validate($request->rules());
            $validated['updated_by'] = auth()->user()->email;
            $validated['updated_at'] = $now;

            if ($request->tanggal_selesai) {
                $tanggal_selesai = strtotime(str_replace("/", "-", $request->tanggal_selesai));
                $validated['tanggal_selesai'] = date('Y-m-d', $tanggal_selesai);
            }

            // update report
            $do_update = $reportService->update($validated);
            if ($do_update) {
                // upload dan simpan gambar report
                $fileExist = array();
                $oldImages = ReportServiceImage::whereBelongsTo($reportService)->where("status", "SESUDAH")->get();
                $newImages = $request['report_images'];
                if ($newImages > 0) {
                    foreach ($newImages as $img => $image) {
                        // check existing file remove
                        if (!is_object($image)) {
                            $decodeFile = json_decode($image);
                            array_push($fileExist, $decodeFile->name);
                            continue;
                        }

                        // do upload and save to db
                        $imageName = time() . strtolower(Str::random(10)) . '.' . $image->extension();
                        $image->move(public_path('media/images/report'), $imageName);

                        ReportServiceImage::create([
                            'report_service_id' => $reportService->id,
                            'image' => 'media/images/report/' . $imageName,
                            'status' => 'SESUDAH',
                            'created_by' => auth()->user()->email,
                        ]);
                    }
                }

                // delete removed gambar
                foreach ($oldImages as $old => $oldFile) {
                    $file_path = explode("/", $oldFile['image']);
                    $filename = end($file_path);

                    if (!in_array($filename, $fileExist)) {
                        // delete file from server
                        $path = public_path() . "/" . $oldFile['image'];
                        if (file_exists($path)) {
                            unlink($path);
                        }

                        // delete from db
                        $oldFile->delete();
                    }
                }
            }

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Laporan berhasil diupdate",
                'report_service_id' => $reportService->id
            ], 201);
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
     * @param  \App\Models\ReportService  $reportService
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportService $reportService)
    {
        //
    }
}
