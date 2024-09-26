<?php

namespace App\Http\Controllers;

use App\DataTables\BarangDataTable;
use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use DB;
use Carbon\Carbon;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BarangDataTable $dataTable)
    {
        $this->authorize("read barang");
        return $dataTable->render("pages.barang.index");
    }

    public function barang(BarangDataTable $dataTable)
    {
        // Mengambil data barang dengan kondisi status != 'DIHAPUS'
        $barangs = Barang::where('status', '!=', 'DIHAPUS')
        ->where('created_at', '>=', \Carbon\Carbon::now()->subDays(14))
            ->get();
    
        // Menyusun data untuk ditampilkan dalam view
        $data = [
            'barangs' => $barangs
        ];
    
        // Meneruskan data ke view 'website.barang.index'
        return view("website.barang.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create barang");
        return view('pages.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangRequest $request)
    {
        $this->authorize("create barang");

        DB::beginTransaction();
        try {
            $validated = $request->validate($request->rules());
            $validated['status'] = "AKTIF";
            $validated['created_by'] = auth()->user()->email;
    
            // Handle file upload
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fileName = time() . '_' . $foto->getClientOriginalName();
                $foto->move(public_path('media/images/barang'), $fileName);
                $validated['foto'] = 'media/images/barang/' . $fileName;
            }
    
            // Create barang
            Barang::create($validated);
    
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $this->authorize("update barang");
        return view('pages.barang.edit', ['barang' => $barang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBarangRequest  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */

     public function update(UpdateBarangRequest $request, Barang $barang)
     { 
        $this->authorize("update barang");

         DB::beginTransaction();
         try {
             $validated = $request->validate($request->rules());
             $validated['updated_by'] = auth()->user()->email;

            // Handle file upload
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fileName = time() . '_' . $foto->getClientOriginalName();
                $foto->move(public_path('media/images/barang'), $fileName);
                $validated['foto'] = 'media/images/barang/' . $fileName;
            }
 
             // update facility
             $barang->update($validated);
 
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
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $this->authorize("delete barang");

        DB::beginTransaction();
        try {
            // update data to deleted
            $validated['status'] = "DIHAPUS";
            $validated['deleted_at'] = date('Y-m-d H:i:s');
            $validated['deleted_by'] = auth()->user()->email;

            // update barang
            $barang->update($validated);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
