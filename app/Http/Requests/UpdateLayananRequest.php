<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLayananRequest extends FormRequest
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
            "type" => "required|in:RUANG,RKU,KENDARAAN,RUMAH SUSUN,SELASAR,LAPANGAN,PERALATAN",
            "unit_pengelola" => "required|string|max:255",
            "name" => "required|string",
            "description" => "nullable|string",
            "address" => "required|string|max:255",
            "location" => "required|in:GANESHA,SARAGA,JATINANGOR,CIREBON,JAKARTA",
            "large" => "required|numeric|min:1",
            "capacity" => "required|numeric|min:1",
            "price" => "required|numeric",
            "price_for" => "required|in:JAM,HARI",
            "status" => "required|in:AKTIF,TIDAK AKTIF,RUSAK,TIDAK BISA DISEWA,DIHAPUS",
            "layanan_gambar" => "required|array",
            "facility" => "required"
        ];
    }
}
