<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacilityRequest extends FormRequest
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
            "name" => "required|string",
            "fee" => "required|numeric",
            "fee_for" => "required|numeric|min:1",
            "satuan" => "required|string",
            "icon" => "required|string",
            "status" => "required|in:AKTIF,TIDAK AKTIF",
        ];
    }
}
