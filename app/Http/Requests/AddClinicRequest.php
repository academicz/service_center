<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddClinicRequest extends FormRequest
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
            'clinicName' => 'required',
            'location' => 'required',
            'phone' => 'required|numeric|digits:10',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'doctor' => 'required',
        ];
    }

    /**
     * Custom error message
     * @return array
     */
    public function messages()
    {
        return [
            'phone.numeric' => 'Enter a valid phone number',
            'phone.digits' => 'Enter a valid phone number',
            'latitude.required' => 'Mark the location on the map by clicking \'Get Coordinates\' button',
            'latitude.numeric' => 'Mark the location on the map by clicking \'Get Coordinates\' button',
        ];
    }
}
