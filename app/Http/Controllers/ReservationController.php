<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\DataTables\ReservationDataTable;
use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\ExtraFee;
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
                $validated['status'] = "MENUNGGU UPLOAD";
                $validated['expired_payment'] = $now->add(new DateInterval("P3D"));
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

            DB::commit();

            // menjalankan query procedure untuk update kode_sewa
            DB::select('CALL prc_ins_reservations(?)', [$reservation['id']]);

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
        $date = strtotime(str_replace("/", "-", $request->date));

        return Reservation::where('layanan_id', $request->layanan)
            ->where('start_date', '<=', date('Y-m-d', $date) . ' 23:59')
            ->where('end_date', '>=', date('Y-m-d', $date) . ' 00:01')
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function upload_receipt(Request $request, Reservation $reservation)
    {
        Db::beginTransaction();
        try {
            $validated = $request->validate([
                'receipt' => "required|file"
            ]);

            // upload receipt
            $receipt = $request->receipt;
            $fileName = $reservation->id . "-" . strtolower(Str::random(10)) . '.' . $receipt->extension();
            $receipt->move(public_path('media/upload/receipt'), $fileName);

            $validated['receipt'] = 'media/upload/receipt/' . $fileName;
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
        Db::beginTransaction();
        try {
            $validated = $request->validate([
                'surat_permohonan' => "required|file"
            ]);

            // upload surat_permohonan
            $surat_permohonan = $request->surat_permohonan;
            $fileName = $reservation->id . "-" . strtolower(Str::random(10)) . '.' . $surat_permohonan->extension();
            $surat_permohonan->move(public_path('media/upload/surat_permohonan'), $fileName);

            $validated['surat_permohonan'] = 'media/upload/surat_permohonan/' . $fileName;
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
                'diskon' => "numeric"
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
                'fee' => $reservation['fee'],
                'fee_for' => $reservation['fee_for'],
                'extra_fee' => $reservation['extra_fee'],
                'total' => $reservation['total'],
                'receipt' => $reservation['receipt'],
                'surat_permohonan' => $reservation['surat_permohonan'],
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
                DB::raw('SUM(CASE WHEN reservations.status = "DISETUJUI" THEN 1 ELSE 0 END) AS disetujui'),
                DB::raw('SUM(CASE WHEN reservations.status = "DITOLAK" THEN 1 ELSE 0 END) AS ditolak'))
            ->leftJoin('layanans', 'reservations.layanan_id', '=', 'layanans.id')
            ->where('layanans.location', Auth::user()->location)
            ->groupBy('layanans.type')
            ->get();
    
        return view('pages.index', compact('layanans', 'reservations'));
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
