<?php

namespace App\Jobs;

use App\Models\BookingSlot;
use App\Models\Registration;
use App\Models\WorkingSession;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DoctorTimeScheduling implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $doctor;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Registration $doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($r)
    {
        echo $this->doctor->full_name;
//        $bookingSlot = new BookingSlot();
//        $bookingSlot->working_session_id = $this->doctor->id;
//        $bookingSlot->start_time = '10:30';
//        $bookingSlot->end_time = '11:30';
//        $bookingSlot->save();
    }
}
