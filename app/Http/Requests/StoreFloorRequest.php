<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFloorRequest extends FormRequest
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
            'number' => 'nullable',
            'floor_classification' => 'nullable',
            'room_classification' => 'nullable',
            'room_description' => 'nullable',
            'large' => 'nullable|numeric|min:1',
            'capacity' => 'nullable|numeric',
        ];
    }
}
