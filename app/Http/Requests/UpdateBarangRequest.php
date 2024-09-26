<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomor_aset' => "required|numeric",
            'nama_barang' => "required|string",
            'merk' => "required|string",
            'jumlah' => "required|numeric",
            'lokasi' => "required|string",
            'unit_itb' => "required|string",
            'kondisi' => "required|string",
        ];
    }
}
