<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\DataTables\ReservationDataTable;
use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\ExtraFee;
use App\Exports\ExportChart;
use App\Exports\ExportBar;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use DateTimeZone;
use DB;
use Illuminate\Http\Request;
use Str;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReservationDataTable $dataTable)
    {
        $this->authorize("read reservation");
        return $dataTable->render("pages.reservation.index");
    }

    public function indexSewa(ReservationDataTable $dataTable)
    {
        $this->authorize("read reservation");
        return $dataTable->setTotalCondition('!=')->render("pages.reservation.index");
    }
    
    public function indexResource(ReservationDataTable $dataTable)
    {
        $this->authorize("read reservation");
        return $dataTable->setTotalCondition('=')->render("pages.reservation.index");
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
     * @param  \App\Http\Requests\StoreReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationRequest $request)
    {
        DB::beginTransaction();
        try {
            $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $now->format('Y-m-d H:i:s');

            $validated = $request->validate($request->rules());

            // convert to date
            $start_date = strtotime(str_replace("/", "-", $request->start_date));
            $end_date = strtotime(str_replace("/", "-", $request->end_date));

            $validated['start_date'] = date('Y-m-d H:i', $start_date);
            $validated['end_date'] = date('Y-m-d H:i', $end_date);
            $validated['status'] = "MENUNGGU VERIFIKASI";
            $validated['created_by'] = auth()->user()->email;

            if (!auth()->user()->hasRole(["superadmin"])) {
                $validated['status'] = "MENUNGGU REVIEW";
            }

            $reservation = Reservation::create($validated);
            if ($reservation) {
                $extra_fee_details = $request->input("extra_fee_detail");
                if ($extra_fee_details) {
                    foreach ($extra_fee_details as $ef => $extra_fee) {
                        ExtraFee::create([
                            "reservation_id" => $reservation->id,
                            "facility_id" => $extra_fee["facility_id"],
                            "fee" => $extra_fee["fee"],
                        ]);
                    }
                }
            }

            // menjalankan query procedure untuk update kode_sewa
            DB::select('CALL prc_ins_reservations(?)', [$reservation['id']]);

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Reservasi berhasil dibuat",
                'reservation_id' => $reservation->id
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 1,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function review(Request $request, Reservation $reservation)
    {
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $now->format('Y-m-d H:i:s');
        
        Db::beginTransaction();
        try {
            $validated = $request->validate([
                'description' => "required|string|max:200"
            ]);

            $validated['status'] = "MENUNGGU UPLOAD";
            $validated['updated_at'] = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $validated['expired_payment'] = $now->add(new DateInterval("P3D"));
            $reservation->update($validated);

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Sewa Berhasil Disetujui."
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 1,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        $extraFacilities = ExtraFee::whereBelongsTo($reservation)->get();
        return view('pages.reservation.details', [
            'reservation' => $reservation,
            'extraFacilities' => $extraFacilities
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function detail(Reservation $reservation)
    {
        $extraFacilities = ExtraFee::whereBelongsTo($reservation)->get();
        return view('website.reservations.detail', [
            'reservation' => $reservation,
            'extraFacilities' => $extraFacilities
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $startDateTime = Carbon::parse($request->start_date);
        $endDateTime = Carbon::parse($request->end_date);
    
        return Reservation::where('layanan_id', $request->layanan)
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->where(function ($q) use ($startDateTime, $endDateTime) {
                    $q->where('start_date', '<=', $startDateTime)
                        ->where('end_date', '>=', $startDateTime);
                })
                ->orWhere(function ($q) use ($startDateTime, $endDateTime) {
                    $q->where('start_date', '<=', $endDateTime)
                        ->where('end_date', '>=', $endDateTime);
                })
                ->orWhere(function ($q) use ($startDateTime, $endDateTime) {
                    $q->where('start_date', '>=', $startDateTime)
                        ->where('end_date', '<=', $endDateTime);
                });
            })
            ->whereNotIn("status", ["DITOLAK", "DIBATALKAN", "EXPIRED", "WAKTU HABIS"])
            ->count();
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    public function storeEoffice(Request $request, Reservation $reservation)
    {
        // Validate the request data
        $request->validate([
            'eoffice' => 'required|string|max:255',
        ]);

        // Update the reservation with the provided eoffice number
        $reservation->no_eoffice = $request->input('eoffice');
        $reservation->save();

        // Return a response, this can be a redirect or a JSON response based on your needs
        return response()->json(['message' => 'Nomor E-Office berhasil diupdate.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function upload_receipt(Request $request, Reservation $reservation)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'receipt' => "required|file"
            ]);
    
            // upload receipt
            $receipt = $request->file('receipt');
            $fileName = $reservation->id . "-" . strtolower(Str::random(10)) . '.' . $receipt->extension();
    
            // Store the file in the specified storage path
            $path = $receipt->storeAs('private/upload/receipt', $fileName);
    
            $validated['receipt'] = $path;
            $validated['status'] = "MENUNGGU VERIFIKASI";
            $reservation->update($validated);
    
            DB::commit();
            return response()->json([
                'status' => 0,
                
                'message' => "Bukti Pembayaran Berhasil diupload."
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 1,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function upload_permohonan(Request $request, Reservation $reservation)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'surat_permohonan' => "required|file"
            ]);
    
            // Upload surat_permohonan
            $surat_permohonan = $request->file('surat_permohonan');
            $fileName = $reservation->id . "-" . strtolower(Str::random(10)) . '.' . $surat_permohonan->extension();
            
            // Store the file in the private directory
            $path = $surat_permohonan->storeAs('private/upload/surat_permohonan', $fileName, 'local');
    
            $validated['surat_permohonan'] = $path;
            $validated['status'] = "MENUNGGU VERIFIKASI";
            $reservation->update($validated);
    
            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Bukti Pembayaran Berhasil diupload."
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 1,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function verifikasi($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['verif_receipt' => '1']);

        // Jika Anda ingin mengembalikan response JSON, Anda bisa menggunakan:
        return response()->json(['message' => 'Bukti Pembayaran Terverifikasi']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, Reservation $reservation)
    {
        Db::beginTransaction();
        try {
            $validated = $request->validate([
                'description' => "required|string|max:200",
                'bayar' => "required|numeric|min:0"
            ]);

            $validated['status'] = "DISETUJUI";
            $validated['approved_by'] = auth()->user()->email;
            $validated['approved_at'] = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $reservation->update($validated);

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Sewa Berhasil Disetujui."
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 1,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function approve_move(Request $request, Reservation $reservation)
    {
        Db::beginTransaction();
        try {
            // create new Reservation
            $validatedMove = $request->validate([
                'new_layanan_id' => "required",
                'new_layanan_price' => "required"
            ]);

            $newValue = array(
                'layanan_id' => $validatedMove['new_layanan_id'],
                'start_date' => $reservation['start_date'],
                'end_date' => $reservation['end_date'],
                'catatan' => $reservation['catatan'],
                'unit' => $reservation['unit'],
                'fee' => $reservation['fee'],
                'fee_for' => $reservation['fee_for'],
                'extra_fee' => $reservation['extra_fee'],
                'total' => $reservation['total'],
                'receipt' => $reservation['receipt'],
                'surat_permohonan' => $reservation['surat_permohonan'],
                'no_eoffice' => $reservation['no_eoffice'],
                'created_by' => $reservation['created_by'],
                'created_at' => $reservation['created_at'],
                'status' => "DISETUJUI",
                'approved_by' => auth()->user()->email,
                'approved_at' => new DateTime("now", new DateTimeZone('Asia/Jakarta'))
            );
            $newReservation = Reservation::create($newValue);

            if ($newReservation) {
                $extra_fee_details = json_decode($request->input("facility"));
                if ($extra_fee_details) {
                    foreach ($extra_fee_details->facility as $ef => $extra_fee) {
                        if ($extra_fee->facility_id) {
                            ExtraFee::create([
                                "reservation_id" => $newReservation->id,
                                "facility_id" => $extra_fee->facility_id,
                                "fee" => $extra_fee->facilty_fee,
                            ]);
                        }
                    }
                }
            }

            // update old reservation
            $validated = $request->validate([
                'description' => "required|string|max:200"
            ]);

            $validated['status'] = "DIALIHKAN";
            $validated['approved_by'] = auth()->user()->email;
            $validated['approved_at'] = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $validated['new_layanan_id'] = $newReservation->id;
            $reservation->update($validated);

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Sewa Berhasil Dialihkan.",
                'reservation_id' => $newReservation->id,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 1,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, Reservation $reservation)
    {
        Db::beginTransaction();
        try {
            $validated = $request->validate([
                'description' => "required|string|max:200"
            ]);

            $validated['status'] = "DITOLAK";
            $validated['approved_by'] = auth()->user()->email;
            $validated['approved_at'] = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $reservation->update($validated);

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Sewa Berhasil Ditolak."
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 1,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request, Reservation $reservation)
    {
        Db::beginTransaction();
        try {
            $validated = $request->validate([
                'description' => "required|string|max:200"
            ]);

            $validated['status'] = "DIBATALKAN";
            $validated['canceled_by'] = auth()->user()->email;
            $validated['canceled_at'] = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
            $reservation->update($validated);

            DB::commit();
            return response()->json([
                'status' => 0,
                'message' => "Sewa Berhasil Dibatalkan."
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 1,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function admin_status()
    {
        $layanans = DB::table('reservations')
            ->select('layanans.type', DB::raw('COUNT(*) as total'))
            ->leftJoin('layanans', 'reservations.layanan_id', '=', 'layanans.id')
            ->where('layanans.location', Auth::user()->location)
            ->groupBy('layanans.type')
            ->get();
    
        $reservations = DB::table('reservations')
            ->select('layanans.type', 
                DB::raw('SUM(CASE WHEN reservations.status = "MENUNGGU UPLOAD" THEN 1 ELSE 0 END) AS menunggu_upload'),
                DB::raw('SUM(CASE WHEN reservations.status = "MENUNGGU VERIFIKASI" THEN 1 ELSE 0 END) AS menunggu_verifikasi'),
                DB::raw('SUM(CASE WHEN reservations.status != "WAKTU HABIS" AND "DIBATALKAN" THEN 1 ELSE 0 END) AS verif_receipt'),
                DB::raw('SUM(CASE WHEN reservations.status != "WAKTU HABIS" AND reservations.status != "DIBATALKAN" AND reservations.status != "DITOLAK" THEN 1 ELSE 0 END) AS total_reservations'),
                DB::raw('SUM(CASE WHEN reservations.status = "DISETUJUI" THEN 1 ELSE 0 END) AS disetujui'),
                DB::raw('SUM(CASE WHEN reservations.verif_receipt = "1" OR reservations.status = "DISETUJUI" THEN 1 ELSE 0 END) AS verif_receipt'),
                DB::raw('SUM(CASE WHEN reservations.status = "DISETUJUI" THEN 1 ELSE 0 END) AS disetujui'))
            ->leftJoin('layanans', 'reservations.layanan_id', '=', 'layanans.id')
            ->where('layanans.location', Auth::user()->location)
            ->where('layanans.unit_pengelola', Auth::user()->itb_unit)
            ->groupBy('layanans.type')
            ->get();
    
        return view('pages.index', compact('layanans', 'reservations'));
    }

    public function showChart(Request $request)
    {
        $month = $request->input('month', null);
        $chart = DB::table('reservations as r')
            ->select(DB::raw("DATE_FORMAT(r.start_date,'%m') AS no_bulan, DATE_FORMAT(r.start_date,'%M') AS bulan, l.name, COUNT(r.id) AS jumlah"))
            ->join('layanans as l', 'l.id', '=', 'r.layanan_id')
            ->where('l.type', 'RUANG')
            ->where('l.unit_pengelola', '=', Auth::user()->itb_unit)
            ->where('r.status', 'DISETUJUI')
            ->when($month, function ($query) use ($month) {
                return $query->where(DB::raw("DATE_FORMAT(r.start_date,'%m')"), $month);
            })
            ->groupBy(DB::raw("DATE_FORMAT(r.start_date,'%m'), DATE_FORMAT(r.start_date,'%M'), l.name"))
            ->orderBy(DB::raw("DATE_FORMAT(r.start_date,'%m'), l.name"))
            ->get();
    
        return view('pages.index', compact('chart'));
    }
      
    public function exportChart()
    {
        return Excel::download(new ExportChart, 'reservations_chart.xlsx');
    }

    public function showBar(Request $request)
    {
        // Ambil semua data tanpa filter bulan
        $query = DB::table('reservations as r')
            ->join('layanans as l', function ($join) {
                $join->on('l.id', '=', 'r.layanan_id')
                     ->where('l.type', '=', 'RUANG')
                     ->where('l.unit_pengelola', '=', Auth::user()->itb_unit);
            })
            ->select(
                DB::raw('DATE_FORMAT(r.start_date, "%m") as no_bulan'),
                DB::raw('DATE_FORMAT(r.start_date, "%M") as bulan'),
                'r.unit',
                DB::raw('COUNT(r.id) as jumlah')
            )
            ->where('r.status', 'DISETUJUI')
            ->groupBy(
                DB::raw('DATE_FORMAT(r.start_date, "%m")'),
                DB::raw('DATE_FORMAT(r.start_date, "%M")'),
                'r.unit'
            )
            ->orderBy(DB::raw('DATE_FORMAT(r.start_date, "%m")'))
            ->orderBy('r.unit')
            ->get();
    
        // Kirim data ke view
        return view('pages.index', ['bar' => $query]);
    }    

    public function exportBar()
    {
        return Excel::download(new ExportBar, 'reservations_bar.xlsx');
    }

    public function tableBar(Request $request)
    {
        $month = $request->input('month', null);
    
        $bulanIndonesia = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
    
        $query = DB::table('reservations as r')
            ->select(
                DB::raw("DATE_FORMAT(r.start_date,'%m') AS no_bulan"),
                DB::raw("DATE_FORMAT(r.start_date,'%m') AS bulan_key"),
                'r.unit',
                'l.name',
                DB::raw("COUNT(r.id) AS jumlah")
            )
            ->join('layanans as l', 'l.id', '=', 'r.layanan_id')
            ->where([
                ['l.type', 'RUANG'],
                ['l.unit_pengelola', Auth::user()->itb_unit],
                ['r.status', 'DISETUJUI']
            ]);
    
        if ($month && $month != '13') {
            $query->where(DB::raw("DATE_FORMAT(r.start_date,'%m')"), $month);
        }
    
        $tableBar = $query->groupBy('no_bulan', 'bulan_key', 'r.unit', 'l.name')
            ->orderBy('no_bulan')
            ->orderBy('r.unit')
            ->get()
            ->map(function ($item) use ($bulanIndonesia) {
                $item->bulan = $bulanIndonesia[$item->bulan_key] ?? $item->bulan_key;
                return $item;
            });
    
        if ($request->ajax()) {
            return response()->json(['tableBar' => $tableBar]);
        }
    
        return view('pages.index', compact('tableBar'));
    }    

    public function markAsRead($reservation_id)
    {
        $user = Auth::user()->email;
        // Temukan notifikasi berdasarkan reservation_id dan ubah kolom read_content menjadi 1
        DB::table('notifikasi')
            ->where('created_by', $user)
            ->where('reservation_id', $reservation_id)
            ->update(['read_content' => 1]);
    
        // Anda dapat menambahkan respons yang sesuai di sini, seperti pesan sukses atau pengalihan ke halaman lain.
        return redirect('/reservation/' . $reservation_id . '/detail');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
