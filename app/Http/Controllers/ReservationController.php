<?php

namespace App\Http\Controllers;

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
            $validated['status'] = "MENUNGGU UPLOAD";
            $validated['expired_payment'] = $now->add(new DateInterval("P3D"));
            $validated['created_by'] = auth()->user()->email;

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
            ->where('end_date', '>=', date('Y-m-d', $date))->count();
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
                'description' => "required|string|max:200"
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
