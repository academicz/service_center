<?php

namespace App\Jobs;

use App\Constants\Constants;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ScheduleTimingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $doctors = Registration::whereHas('login', function ($query) {
            $query->where('user_category_id', Constants::$DOCTOR_USER);
        })->get();

        foreach ($doctors as $doctor) {
            DoctorTimeScheduling::dispatch($doctor);
        }
    }
}
