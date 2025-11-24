<?php

namespace App\Jobs;

use App\Models\VoiceLog;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessVoiceLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $voiceLog;

    public function __construct(VoiceLog $voiceLog)
    {
        $this->voiceLog = $voiceLog;
    }

    public function handle()
    {
        $this->voiceLog->markAsProcessing();

        try {
            $file = fopen(storage_path('app/public/' . $this->voiceLog->audio_file), 'r');

            $transcription = OpenAI::audio()->transcribe([
                'file' => $file,
                'model' => 'whisper-1',
            ]);

            $response = OpenAI::chat()->create([
                'model' => 'gpt-4-turbo-preview',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a UK pool technician AI. Convert speech to structured logs.'],
                    ['role' => 'user', 'content' => $transcription->text]
                ]
            ]);

            $this->voiceLog->complete($transcription->text, $response->choices[0]->message->content);
        } catch (\Exception $e) {
            Log::error('Voice log processing failed', ['id' => $this->voiceLog->id, 'error' => $e->getMessage()]);
            $this->voiceLog->fail();
        }
    }
}