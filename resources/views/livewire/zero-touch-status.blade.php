{{-- 001 resources/views/livewire/zero-touch-status.blade.php --}}
<div class="max-w-6xl mx-auto">
    <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-3xl p-20 text-white text-center shadow-2xl">
        <h1 class="text-7xl font-black mb-8">ZERO-TOUCH DEVICE SYNC</h1>
        <p class="text-4xl opacity-90">Your Palintest & ERMES devices are fully connected</p>
        <p class="text-5xl font-bold mt-12">No CSV. No Bluetooth. No Human Error.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mt-16">
        <div class="bg-white rounded-3xl shadow-2xl p-16 text-center">
            <div class="text-9xl mb-8">📊</div>
            <h3 class="text-4xl font-black text-indigo-900 mb-4">Palintest Cloud</h3>
            <p class="text-8xl font-black text-green-600">✓</p>
            <p class="text-3xl text-gray-700 mt-6">Last sync: {{ $palintestLastSync ?? 'Never' }}</p>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl p-16 text-center">
            <div class="text-9xl mb-8">⚡</div>
            <h3 class="text-4xl font-black text-purple-900 mb-4">ERMES Cloud</h3>
            <p class="text-8xl font-black text-green-600">✓</p>
            <p class="text-3xl text-gray-700 mt-6">Last sync: {{ $ermesLastSync ?? 'Never' }}</p>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-3xl shadow-2xl p-16 text-center text-white">
            <div class="text-9xl mb-8">🧠</div>
            <h3 class="text-4xl font-black mb-4">100% AUTOMATED</h3>
            <p class="text-3xl">Every reading flows directly into LRM</p>
            <p class="text-6xl font-black mt-8">PERFECT COMPLIANCE</p>
        </div>
    </div>
</div>