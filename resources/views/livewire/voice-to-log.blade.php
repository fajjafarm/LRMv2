{{-- 002 resources/views/livewire/voice-to-log.blade.php --}}
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl shadow-2xl p-16 text-center">
        <h1 class="text-6xl font-black text-indigo-900 mb-12">Voice-to-Log Assistant</h1>

        @if(!$recording && !$processing && !$result)
            <div class="py-24">
                <div class="bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full w-64 h-64 mx-auto mb-12 flex items-center justify-center">
                    <svg class="w-40 h-40 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                    </svg>
                </div>
                <p class="text-3xl text-gray-700 mb-16">Hold button and speak your service log</p>
                <button wire:click="$set('recording', true)" 
                        class="bg-red-600 hover:bg-red-700 text-white w-48 h-48 rounded-full text-8xl font-black shadow-2xl transition transform hover:scale-110">
                    🎤
                </button>
            </div>
        @endif

        @if($recording)
            <div class="py-32">
                <div class="animate-pulse">
                    <div class="bg-red-600 rounded-full w-80 h-80 mx-auto mb-12 flex items-center justify-center">
                        <div class="text-white text-9xl">●</div>
                    </div>
                </div>
                <p class="text-5xl font-black text-red-600 mb-12">RECORDING...</p>
                <button wire:click="stopRecording" 
                        class="bg-gray-900 hover:bg-black text-white px-24 py-12 rounded-3xl text-4xl font-black">
                    STOP & SEND TO AI
                </button>
            </div>
        @endif

        @if($processing)
            <div class="py-32">
                <div class="animate-spin rounded-full h-64 w-64 border-b-8 border-indigo-600 mx-auto mb-12"></div>
                <p class="text-5xl font-black text-indigo-600">AI IS THINKING...</p>
            </div>
        @endif

        @if($result)
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl p-16 border-8 border-green-500">
                <h2 class="text-5xl font-black text-green-800 mb-12">PERFECT! AI UNDERSTOOD:</h2>
                <div class="bg-white rounded-3xl p-12 mb-12 text-3xl italic text-gray-800">
                    "{{ $result['transcription'] }}"
                </div>
                <div class="space-y-8">
                    @foreach($result['actions'] as $action)
                        <div class="bg-blue-50 rounded-2xl p-10 border-l-8 border-blue-600">
                            <p class="text-3xl font-bold text-blue-900">✓ {{ $action }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-16">
                    <button wire:click="confirmAndSave" 
                            class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-32 py-16 rounded-3xl text-5xl font-black shadow-2xl transition transform hover:scale-105">
                        CONFIRM & SAVE ALL
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>