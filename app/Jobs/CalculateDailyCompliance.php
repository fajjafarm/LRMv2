<?php

namespace App\Jobs;

use App\Models\Facility;
use App\Services\ComplianceCalculator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class CalculateDailyCompliance implements ShouldQueue
{
    use Queueable;

    public function handle()
    {
        Facility::chunk(50, function ($facilities) {
            foreach ($facilities as $facility) {
                app(ComplianceCalculator::class)->calculateForFacility($facility);
            }
        });
    }
}