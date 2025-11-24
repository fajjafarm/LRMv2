<?php

namespace App\Jobs;

use App\Models\Facility;
use App\Services\AiAssistant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateDailyAiRecommendations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        Facility::where('is_active', true)->chunk(20, function ($facilities) {
            foreach ($facilities as $facility) {
                app(AiAssistant::class)->generateDailyRecommendations($facility);
            }
        });
    }
}