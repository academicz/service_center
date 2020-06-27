<?php

namespace App\Rules;

use App\Constants\Constants;
use App\Models\WorkingSession;
use DateTime;
use Illuminate\Contracts\Validation\Rule;

class EditWeekDayEndingTime implements Rule
{
    private $doctor, $weekDay, $startingTime, $sessionId;

    /**
     * Create a new rule for checking if time session overlaps with other.
     *
     * WeekDayStartingTime constructor.
     * @param $doctor
     * @param $weekDay
     * @param $startingTime
     * @param $sessionId
     */
    public function __construct($doctor, $weekDay, $startingTime, $sessionId)
    {
        $this->doctor = $doctor;
        $this->weekDay = $weekDay;
        $this->startingTime = $startingTime;
        $this->sessionId = $sessionId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $workingSession = WorkingSession::find($this->sessionId);
        $currentSession = new DateTime($value);
        $currentStartTime = new DateTime($this->startingTime);
        $startTime = new DateTime($workingSession->start_time);
        $endTime = new DateTime($workingSession->end_time);

        if ($currentSession == $endTime && $startTime == $currentStartTime) {
            return true;
        } else {
            $workingSessions = WorkingSession::where([['week_day_id', $this->weekDay], ['status', '!=', Constants::$DELETED_SESSION_STATUS]])
                ->whereHas('clinic', function ($query) {
                    $query->where('doctor_details_id', $this->doctor);
                })->get();

            if ($workingSessions->count()) {
                $startingTime = new DateTime($this->startingTime);

                foreach ($workingSessions as $workingSession) {
                    /**
                     * if current time is equal to or in between existing time
                     */
                    if (
                        (new DateTime($workingSession->start_time) < $currentSession || new DateTime($workingSession->start_time) == $currentSession)
                        && ($currentSession < new DateTime($workingSession->end_time) || $currentSession == new DateTime($workingSession->end_time))
                        && (new DateTime($workingSession->end_time) != $currentSession)
                    ) {
                        return false;
                    }
                }
                foreach ($workingSessions as $workingSession) {

                    /**
                     * If any time interval exist inside current selected time interval
                     */
                    if (
                        $startingTime < new DateTime($workingSession->start_time)
                        && $currentSession > new DateTime($workingSession->end_time)
                        && (new DateTime($workingSession->end_time) != $currentSession)
                    ) {
                        return false;
                    }
                }
                return true;
            } else {
                return true;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A session exist on the same time interval';
    }
}
