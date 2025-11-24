<div class="space-y-8">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">
                    {{ auth()->user()->business->name }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    Business Overview • {{ $facilities->count() }} Facilities
                </p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-indigo-600">£{{ number_format(auth()->user()->business->monthly_price, 2) }}/mo</div>
                <div class="text-sm text-gray-500">Current Plan</div>
            </div>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        @php
            $kpis = [
                ['label' => 'Facilities', 'value' => $stats['total_facilities'], 'color' => 'indigo'],
                ['label' => 'Open Tasks', 'value' => $stats['open_tasks'], 'color' => 'red'],
                ['label' => 'Training Alerts', 'value' => $stats['training_alerts'], 'color' => 'orange'],
                ['label' => 'pH Issues', 'value' => $stats['out_of_range_tests'], 'color' => 'yellow'],
                ['label' => 'Overdue Service', 'value' => $stats['overdue_service'], 'color' => 'purple'],
                ['label' => 'Low Stock', 'value' => $stats['low_stock_chemicals'], 'color' => 'pink'],
            ];
        @endphp

        @foreach($kpis as $kpi)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 text-center transform hover:scale-105 transition">
                <div class="text-4xl font-bold text-{{ $kpi['color'] }}-600">
                    {{ $kpi['value'] }}
                </div>
                <div class="text-gray-600 dark:text-gray-400 mt-2">{{ $kpi['label'] }}</div>
            </div>
        @endforeach
    </div>

    <!-- Facility Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($facilities as $facility)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-8">
                    <h3 class="text-2xl font-bold">{{ $facility->name }}</h3>
                    <p class="opacity-90 mt-2">{{ $facility->subFacilities->count() }} sub-facilities</p>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">Open Tasks</span>
                        <span class="text-2xl font-bold">{{ $facility->tasks()->open()->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">Last Test</span>
                        <span class="text-sm">{{ $facility->latestTest()?->tested_at->diffForHumans() ?? 'Never' }}</span>
                    </div>
                    <button wire:click="$set('selectedFacility', {{ $facility->id }})" 
                            class="w-full bg-indigo-600 text-white py-3 rounded-lg font-bold hover:bg-indigo-700 transition">
                        Enter {{ $facility->name }}
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>