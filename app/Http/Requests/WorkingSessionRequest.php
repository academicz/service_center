<?php

namespace App\Http\Requests;

use App\Rules\WeekDayEndingTime;
use App\Rules\WeekDayStartingTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class WorkingSessionRequest extends FormRequest
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
            'id' => 'required',
            'clinic' => 'required',
            'weekDay' => 'required',
            'sessionTitle' => 'required',
            'patients' => 'required|numeric',
            'startingTime' => ['required',
                new WeekDayStartingTime(
                    Input::get('id'),
                    Input::get('weekDay')
                )],
            'endingTime' => ['required',
                'after:startingTime',
                new WeekDayEndingTime(
                    Input::get('id'),
                    Input::get('weekDay'),
                    Input::get('startingTime')
                )],
        ];
    }

    /**
     * Custom error message
     * @return array
     */
    public function messages()
    {
        return [
            'patients.required' => 'Number of patients in session is required',
            'patients.numeric' => 'Enter a valid number',
            'endingTime.after' => 'Ending time must be greater than starting time'
        ];
    }
}
