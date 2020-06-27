<?php

namespace App\Http\Requests;

use App\Rules\EditWeekDayEndingTime;
use App\Rules\EditWeekDayStartingTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class UpdateWorkingSessionRequest extends FormRequest
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
                new EditWeekDayStartingTime(
                    Input::get('id'),
                    Input::get('weekDay'),
                    Input::get('sessionId')
                )],
            'endingTime' => ['required',
                'after:startingTime',
                new EditWeekDayEndingTime(
                    Input::get('id'),
                    Input::get('weekDay'),
                    Input::get('startingTime'),
                    Input::get('sessionId')
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
