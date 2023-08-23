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
            'building_id' => 'required',
            'number' => 'required',
            'floor_classification' => 'required',
            'room_classification' => 'required',
            'room_description' => 'required',
            'large' => 'required|numeric|min:1',
            'capacity' => 'nullable|numeric',
        ];
    }
}
