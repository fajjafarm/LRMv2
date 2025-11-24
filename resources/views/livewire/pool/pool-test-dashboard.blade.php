<div class="space-y-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
            Pool Testing Dashboard
        </h1>
        <div class="grid grid-cols-4 gap-6">
            <div class="text-center">
                <div class="text-5xl font-bold text-green-600">{{ $todayTests }}</div>
                <div class="text-gray-600">Tests Today</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold text-blue-600">{{ $inRange }}</div>
                <div class="text-gray-600">In Range</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold text-red-600">{{ $outOfRange }}</div>
                <div class="text-gray-600">Out of Range</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold text-purple-600">{{ $pendingChecks }}</div>
                <div class="text-gray-600">Checks Due</div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-8">
        <h2 class="text-2xl font-bold mb-6">Recent Tests</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b dark:border-gray-700">
                        <th class="pb-4">Pool</th>
                        <th class="pb-4">Time</th>
                        <th class="pb-4">Temp</th>
                        <th class="pb-4">Free Cl</th>
                        <th class="pb-4">pH</th>
                        <th class="pb-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTests as $test)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="py-4">{{ $test->subFacility->name }}</td>
                            <td class="py-4">{{ $test->tested_at->format('H:i') }}</td>
                            <td class="py-4">{{ $test->temperature }}°C</td>
                            <td class="py-4">{{ $test->free_chlorine }}</td>
                            <td class="py-4">
                                <span class="{{ $test->ph < 7.2 || $test->ph > 7.8 ? 'text-red-600 font-bold' : 'text-green-600' }}">
                                    {{ $test->ph }}
                                </span>
                            </td>
                            <td class="py-4">
                                @if($test->isOutOfRange())
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">ACTION REQUIRED</span>
                                @else
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Good</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>