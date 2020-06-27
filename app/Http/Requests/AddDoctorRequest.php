<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDoctorRequest extends FormRequest
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
            'name' => 'required',
            'age' => ['required','numeric'],
            'location' => 'required',
            'pin' => 'required|numeric|digits:6',
            'address' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'gender' => 'required',
            'specialisations' => 'required',
            'qualifications'=>'required',
            'medicalRegistrationNumber' => 'required',
            'experience' => 'required',
            'consultingFees' => 'required|numeric',
        ];
    }

    /**
     * Custom error message
     * @return array
     */
    public function messages()
    {
        return [
            'age.numeric' => 'Enter a valid age',
            'age.regexp' => 'Enter a valid age',
            'pin.numeric' => 'Enter a valid pin code',
            'pin.digits' => 'Enter a valid pin code',
            'phone.numeric' => 'Enter a valid phone number',
            'phone.digits' => 'Enter a valid phone number',
            'consultingFees.numeric' => 'Enter a valid fees amount',
        ];
    }
}
