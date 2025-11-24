{{-- 005 resources/views/livewire/compliance-score-card.blade.php --}}
<div class="bg-gradient-to-br from-indigo-rose-500 via-purple-600 to-indigo-700 rounded-3xl p-12 text-white text-center shadow-2xl">
    <p class="text-3xl mb-6 opacity-90">Real-Time Compliance Score</p>
    <div class="text-9xl font-black">
        {{ $score ?? 0 }}
    </div>
    <p class="text-4xl mt-8 font-bold">
        {{ $score >= 95 ? 'EXCELLENT' : ($score >= 85 ? 'GOOD' : 'ACTION REQUIRED') }}
    </p>
</div>