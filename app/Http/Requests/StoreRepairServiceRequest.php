<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRepairServiceRequest extends FormRequest
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
            "title" => "required|string|max:200",
            "status" => "required|string",
            "unit" => "required|string",
            "total" => "required|numeric",
            "nomor_surat" => "nullable|string|max:100",
            "pengajuan_detail" => "required"
        ];
    }
}
