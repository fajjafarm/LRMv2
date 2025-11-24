{{-- 002 resources/views/livewire/pool/latest-tests.blade.php --}}
<div class="bg-white rounded-3xl shadow-2xl p-8">
    <h2 class="text-3xl font-bold text-indigo-900 mb-8">Latest Pool Tests</h2>

    <div class="space-y-6">
        @foreach($tests as $test)
            <div class="bg-gradient-to-r {{ $test->isOutOfRange() ? 'from-red-50 to-pink-50' : 'from-green-50 to-emerald-50' }} rounded-2xl p-8 border-l-8 {{ $test->isOutOfRange() ? 'border-red-600' : 'border-green-600' }}">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold">{{ $test->subFacility->name }}</h3>
                        <p class="text-lg text-gray-600">{{ $test->tested_at->diffForHumans() }}</p>
                    </div>
                    <div class="text-right space-y-2">
                        <p class="text-3xl font-black text-indigo-700">{{ $test->ph }}</p>
                        <p class="text-xl">Free Cl: {{ $test->free_chlorine }} ppm</p>
                    </div>
                </div>
                @if($test->isOutOfRange())
                    <div class="mt-6 bg-red-100 border border-red-400 text-red-700 px-8 py-4 rounded-xl text-xl font-bold">
                        ACTION REQUIRED – Out of Range
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>