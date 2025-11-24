<?php

namespace App\Jobs;

use App\Models\DeviceIntegration;
use App\Services\PalintestSyncService;
use App\Services\ErmesSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncAllDevices implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        DeviceIntegration::where('is_active', true)->chunk(10, function ($integrations) {
            foreach ($integrations as $integration) {
                try {
                    if ($integration->isPalintest()) {
                        app(PalintestSyncService::class)->sync($integration);
                    } elseif ($integration->isErmes()) {
                        app(ErmesSyncService::class)->sync($integration);
                    }
                } catch (\Exception $e) {
                    Log::error("Device sync failed for ID {$integration->id}", [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                }
            }
        });
    }
}