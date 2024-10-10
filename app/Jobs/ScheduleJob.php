<?php

namespace App\Jobs;

use App\Mail\ScheduleNotification;
use App\Models\Vaccination;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $records = $this->getTomorrowVaccinations();

        foreach ($records as $record) {
            $this->sendNotification($record);
        }
    }

    private function getTomorrowVaccinations()
    {
        return Vaccination::whereDate('scheduled_date', Carbon::tomorrow())->get();
    }

    private function sendNotification(Vaccination $record): void
    {
        try {
            Mail::to($record->email)->send(new ScheduleNotification($record));
        } catch (\Exception $e) {
            Log::error('Failed to send email to ' . $record->email . ': ' . $e->getMessage());
        }
    }
}
