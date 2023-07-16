<?php

namespace App\Http\Controllers;

use App\Models\LayananGambar;
use App\Http\Requests\StoreLayananGambarRequest;
use App\Http\Requests\UpdateLayananGambarRequest;
use App\Http\Requests\UploadLayananGambarRequest;
use Illuminate\Http\Request;
use Str;

class LayananGambarController extends Controller
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
     * Store a newly upload resource in storage.
     *
     * @param  \App\Http\Requests\UploadLayananGambarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $this->authorize("create layanan");

        $image = $request->file('file');
        $imageName = time() . strtolower(Str::random(10)) . '.' . $image->extension();
        $image->move(public_path('images/layanan'), $imageName);

        return response()->json(['success' => $imageName]);
    }

    /**
     * Store a newly upload resource in storage.
     *
     * @param  \App\Http\Requests\UploadLayananGambarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $this->authorize("create layanan");
        $filename =  $request->get('filename');
        $path = public_path('images/layanan/') . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLayananGambarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLayananGambarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LayananGambar  $layananGambar
     * @return \Illuminate\Http\Response
     */
    public function show(LayananGambar $layananGambar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LayananGambar  $layananGambar
     * @return \Illuminate\Http\Response
     */
    public function edit(LayananGambar $layananGambar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLayananGambarRequest  $request
     * @param  \App\Models\LayananGambar  $layananGambar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLayananGambarRequest $request, LayananGambar $layananGambar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LayananGambar  $layananGambar
     * @return \Illuminate\Http\Response
     */
    public function destroy(LayananGambar $layananGambar)
    {
        //
    }
}
