<?php

namespace App\Http\Controllers;

use App\DataTables\LayananDataTable;
use App\Models\Layanan;
use App\Http\Requests\StoreLayananRequest;
use App\Http\Requests\UpdateLayananRequest;
use App\Models\LayananGambar;
use App\Models\Reservation;
use App\Models\ServiceFacility;
use DB;
use Illuminate\Http\Request;
use Str;

class LayananController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:read layanan");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananDataTable $dataTable)
    {
        $this->authorize("read layanan");
        return $dataTable->render("pages.layanan.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create layanan");
        return view('pages.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLayananRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLayananRequest $request)
    {
        $this->authorize("create layanan");
        DB::beginTransaction();
        try {
            $validated = $request->validate($request->rules());
            $validated['created_by'] = auth()->user()->email;

            // create layanan
            $layanan = Layanan::create($validated);

            if ($layanan) {
                // save Fasilitas Layanan
                $facility = json_decode($validated['facility']);
                foreach ($facility->facility as $key => $facility) {
                    if ($facility->quantity < 1) {
                        throw new \Exception('Jumlah Fasilitas minimal 1');
                    } elseif ($facility->type == 'TAMBAHAN' && $facility->fee <= 0) {
                        throw new \Exception('Biaya minimal Rp. 1 untuk fasilitas tambahan.');
                    }

                    ServiceFacility::create([
                        'layanan_id' => $layanan->id,
                        'facility_id' => $facility->facility_id,
                        'type' => $facility->type,
                        'fee' => $facility->fee,
                        'quantity' => $facility->quantity,
                        'status' => 'AKTIF',
                        'created_by' => auth()->user()->email,
                        'updated_by' => auth()->user()->email,
                    ]);
                }

                // upload dan simpan gambar layanan
                foreach ($validated['layanan_gambar'] as $layanan_gambar => $image) {
                    // do upload and save to db
                    $imageName = time() . strtolower(Str::random(10)) . '.' . $image->extension();
                    $image->move(public_path('media/images/layanan'), $imageName);

                    LayananGambar::create([
                        'layanan_id' => $layanan->id,
                        'picture' => 'media/images/layanan/' . $imageName,
                        'status' => 'AKTIF',
                        'created_by' => auth()->user()->email,
                    ]);
                }
            }

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
     *W
     * @param  \App\Models\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function show(Layanan $layanan)
    {
        $this->authorize("read layanan");
        return view('pages.layanan.details', [
            'layanan' => $layanan,
            'layanan_gambars' => LayananGambar::whereBelongsTo($layanan)->get(),
            'facilities' => ServiceFacility::whereBelongsTo($layanan)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Layanan $layanan)
    {
        $this->authorize("update layanan");
        $images = LayananGambar::whereBelongsTo($layanan)->get();
        $files = array();
        foreach ($images as $image) {
            $file_path = $image['picture'];
            $dir_file = explode("/", $file_path);

            $obj['name'] = end($dir_file);
            $obj['size'] = filesize($file_path);
            $obj['path'] = url($file_path);

            array_push($files, $obj);
        }
        $facilities = ServiceFacility::with('facility')->whereBelongsTo($layanan)->get()->toArray();

        return view('pages.layanan.edit', [
            'layanan' => $layanan,
            'layanan_gambars' => $files,
            'facilities' => $facilities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLayananRequest  $request
     * @param  \App\Models\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLayananRequest $request, Layanan $layanan)
    {
        $this->authorize("update layanan");
        Db::beginTransaction();
        try {
            // update data layanan
            $validated = $request->validate($request->rules());
            $validated['updated_by'] = auth()->user()->email;
            $layanan->update($validated);

            // get request facility
            $facilities = json_decode($validated['facility']);

            // delete old facility
            ServiceFacility::whereBelongsTo($layanan)->delete();

            // update facilities
            if (count($facilities->facility) > 0) {
                foreach ($facilities->facility as $key => $facility) {
                    if ($facility->quantity < 1) {
                        throw new \Exception('Jumlah Fasilitas minimal 1');
                    } elseif ($facility->type == 'TAMBAHAN' && $facility->fee <= 0) {
                        throw new \Exception('Biaya minimal Rp. 1 untuk fasilitas tambahan.');
                    }

                    ServiceFacility::create([
                        'layanan_id' => $layanan->id,
                        'facility_id' => $facility->facility_id,
                        'type' => $facility->type,
                        'fee' => $facility->fee,
                        'quantity' => $facility->quantity,
                        'status' => 'AKTIF',
                        'created_by' => auth()->user()->email,
                        'updated_by' => auth()->user()->email,
                    ]);
                }
            }

            // update gambar layanan
            $oldImages = LayananGambar::whereBelongsTo($layanan)->get();
            $fileExist = array();
            $newImages = $validated['layanan_gambar'];
            foreach ($newImages as $newImage => $file) {
                // check existing file remove
                if (!is_object($file)) {
                    $decodeFile = json_decode($file);
                    array_push($fileExist, $decodeFile->name);
                    continue;
                }

                // do upload and save new image to db
                $imageName = time() . strtolower(Str::random(10)) . '.' . $file->extension();
                $file->move(public_path('media/images/layanan'), $imageName);

                LayananGambar::create([
                    'layanan_id' => $layanan->id,
                    'picture' => 'media/images/layanan/' . $imageName,
                    'status' => 'AKTIF',
                    'created_by' => auth()->user()->email,
                ]);
            }

            // delete removed gambar
            foreach ($oldImages as $old => $oldFile) {
                $file_path = explode("/", $oldFile['picture']);
                $filename = end($file_path);

                if (!in_array($filename, $fileExist)) {
                    // delete file from server
                    $path = public_path() . $oldFile['picture'];
                    if (file_exists($path)) {
                        unlink($path);
                    }

                    // delete from db
                    $oldFile->delete();
                }
            }

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
     * @param  \App\Models\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layanan $layanan)
    {
        DB::beginTransaction();
        try {
            // check if facility is used
            $is_used = Reservation::where('layanan_id', $layanan->id)->count();
            if ($is_used > 0) {
                throw new \Exception('Data Layanan pernah tersimpan di sewa, silahkan untuk ubah status ke Tidak Aktif / Tidak Disewa');
            }

            // update data to deleted
            $validated['status'] = "DIHAPUS";
            $validated['deleted_at'] = date('Y-m-d H:i:s');
            $validated['deleted_by'] = auth()->user()->email;
            $layanan->update($validated);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function find(Request $request)
    {
        $id = $request->id;
        $type = $request->type;
        $price = $request->price;
        $search = $request->search;

        $layanans = Layanan::with(['layanan_gambars'])
            ->select('layanans.*', 'layanans.name as title')
            ->leftJoin('reservations', 'layanans.id', '=', 'reservations.layanan_id')
            ->whereIn(DB::raw('coalesce(reservations.status, "TERSEDIA")'), ['TERSEDIA', 'EXPIRED', 'DITOLAK', 'DIBATALKAN'])
            ->where('layanans.type', $type)
            ->where('layanans.price', $price)
            ->where('layanans.id', "!=", $id)
            ->when($search != null, function ($q) use ($search) {
                $q->where('layanans.name', 'like', '%' . $search . '%');
            })
            ->limit(10)
            ->get();

        $response = array();
        foreach ($layanans as $layanan) {
            $images = LayananGambar::whereBelongsTo($layanan)->first();
            $picture = ($images) ? $images->picture : "";
            $response[] = array(
                "id" => $layanan->id,
                "text" => $layanan->name,
                "type" => $layanan->type,
                "price" => $layanan->price,
                "address" => $layanan->address,
                "location" => $layanan->location,
                "large" => $layanan->large,
                "capacity" => $layanan->capacity,
                "images" => $picture
            );
        }
        return response()->json($response);
    }
}
