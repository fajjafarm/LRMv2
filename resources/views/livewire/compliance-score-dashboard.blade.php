{{-- 002 resources/views/livewire/compliance-score-dashboard.blade.php --}}
<div class="max-w-7xl mx-auto">
    <!-- Hero Score -->
    <div class="text-center py-20 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-3xl shadow-2xl text-white">
        <p class="text-4xl font-light mb-8">Your Real-Time Compliance Score</p>
        <div class="text-9xl font-black">{{ $latestScore?->score ?? 0 }}</div>
        <p class="text-5xl font-bold mt-8">/100</p>
        <p class="text-4xl mt-12">
            {{ $latestScore?->score >= 95 ? 'EXCELLENT – Ready for HSE' : ($latestScore?->score >= 85 ? 'GOOD – Minor Actions' : 'ACTION REQUIRED') }}
        </p>
    </div>

    <!-- Category Breakdown -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-10 mt-16">
        @foreach($latestScore?->breakdown ?? [] as $category => $score)
            <div class="text-center">
                <div class="relative inline-block">
                    <svg class="w-48 h-48 transform -rotate-90">
                        <circle cx="96" cy="96" r="80" stroke="#e5e7eb" stroke-width="16" fill="none"/>
                        <circle cx="96" cy="96" r="80" 
                                stroke="{{ $score >= 95 ? '#10b981' : ($score >= 85 ? '#f59e0b' : '#ef4444') }}"
                                stroke-width="16" fill="none"
                                stroke-dasharray="{{ $score * 5.026 }} 314"
                                class="transition-all duration-1000"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center text-5xl font-black">
                        {{ $score }}
                    </div>
                </div>
                <p class="text-2xl font-bold mt-8 capitalize">{{ str_replace('_', ' ', $category) }}</p>
            </div>
        @endforeach
    </div>
</div>