<?php

namespace App\Http\Controllers;

use App\Models\ExtraFee;
use App\Http\Requests\StoreExtraFeeRequest;
use App\Http\Requests\UpdateExtraFeeRequest;

class ExtraFeeController extends Controller
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
     * @param  \App\Http\Requests\StoreExtraFeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExtraFeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExtraFee  $extraFee
     * @return \Illuminate\Http\Response
     */
    public function show(ExtraFee $extraFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExtraFee  $extraFee
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtraFee $extraFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExtraFeeRequest  $request
     * @param  \App\Models\ExtraFee  $extraFee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExtraFeeRequest $request, ExtraFee $extraFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExtraFee  $extraFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExtraFee $extraFee)
    {
        //
    }
}
