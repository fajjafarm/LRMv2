{{-- 002 resources/views/service/recurring.blade.php --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <h1 class="text-6xl font-black text-indigo-900 text-center mb-12">Recurring Service Schedules</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <div class="bg-indigo-50 rounded-3xl p-10 text-center">
                <p class="text-8xl font-black text-indigo-600">{{ $total }}</p>
                <p class="text-3xl font-bold mt-4">Active Schedules</p>
            </div>
            <div class="bg-green-50 rounded-3xl p-10 text-center">
                <p class="text-8xl font-black text-green-600">{{ $onTrack }}</p>
                <p class="text-3xl font-bold mt-4">On Track</p>
            </div>
            <div class="bg-yellow-50 rounded-3xl p-10 text-center">
                <p class="text-8xl font-black text-yellow-600">{{ $dueSoon }}</p>
                <p class="text-3xl font-bold mt-4">Due Soon</p>
            </div>
            <div class="bg-red-50 rounded-3xl p-10 text-center">
                <p class="text-8xl font-black text-red-600">{{ $overdue }}</p>
                <p class="text-3xl font-bold mt-4">OVERDUE</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($schedules as $schedule)
                @php $next = $schedule->next_due_date @endphp
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-l-12 {{ $next?->isPast() ? 'border-red-600' : 'border-indigo-600' }}">
                    <div class="bg-gradient-to-r {{ $next?->isPast() ? 'from-red-600 to-red-700' : 'from-indigo-600 to-purple-600' }} text-white p-8">
                        <h3 class="text-3xl font-black">{{ $schedule->title }}</h3>
                        <p class="text-xl mt-2 opacity-90">{{ $schedule->schedulable->name }}</p>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="text-2xl font-bold">
                            Next Due: {{ $next?->format('d M Y') }}
                        </div>
                        @if($next?->isPast())
                            <div class="bg-red-100 text-red-800 px-8 py-6 rounded-2xl text-3xl font-black text-center">
                                OVERDUE by {{ $next->diffInDays() }} days
                            </div>
                        @endif
                        <button wire:click="logService({{ $schedule->id }})" 
                                class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white py-8 rounded-2xl text-3xl font-black shadow-2xl transition transform hover:scale-105">
                            Log Service Completed
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>