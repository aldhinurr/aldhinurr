<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFloorRequest extends FormRequest
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
            'building_id' => 'nullable',
            'number' => 'required',
            'kode_ruang' => 'required',
            'unit_itb' => 'required',
            'floor_classification' => 'nullable',
            'room_classification' => 'nullable',
            'kategori_ruangan' => 'required',
            'gedung' => 'required',
            'room_description' => 'nullable',
            'large' => 'nullable|numeric',
            'capacity' => 'nullable|numeric',
            'tgl_singkronisasi' => 'nullable',
            'flag_tambah' => 'nullable',
        ];
    }
}
