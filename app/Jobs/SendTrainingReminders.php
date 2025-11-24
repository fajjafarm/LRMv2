// 004 app/Jobs/SendTrainingReminders.php
<?php

namespace App\Jobs;

use App\Models\TrainingSession;
use App\Mail\TrainingReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTrainingReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $tomorrow = now()->addDay()->startOfDay();

        TrainingSession::whereDate('date', $tomorrow)->get()->each(function ($session) {
            $session->attendees->each(function ($attendee) {
                Mail::to($attendee->identifier)->send(new TrainingReminder($session, $attendee));
            });
        });
    }
}