<?php

namespace App\Http\Controllers;

use App\DataTables\LayananDataTable;
use App\Models\Layanan;
use App\Http\Requests\StoreLayananRequest;
use App\Http\Requests\UpdateLayananRequest;
use App\Models\LayananGambar;
use DB;
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

            // upload dan simpan gambar layanan
            if ($layanan) {
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
        }

        return response()->json(['success' => $imageName]);
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
            'layanan_gambars' => LayananGambar::whereBelongsTo($layanan)->get()
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

        return view('pages.layanan.edit', [
            'layanan' => $layanan,
            'layanan_gambars' => $files
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
        // update data layanan
        $validated = $request->validate($request->rules());
        $validated['updated_by'] = auth()->user()->email;
        $layanan->update($validated);

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layanan $layanan)
    {
        // update data to deleted
        $validated['status'] = "DIHAPUS";
        $validated['deleted_at'] = date('Y-m-d H:i:s');
        $validated['deleted_by'] = auth()->user()->email;
        $layanan->update($validated);
    }
}
