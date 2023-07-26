<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'layanan_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'fee' => 'required|numeric|min:0',
            'fee_for' => 'required',
            'extra_fee' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ];
    }
}
