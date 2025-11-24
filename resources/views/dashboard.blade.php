{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto">
        @if(auth()->user()->currentFacility)
            <h1 class="text-5xl font-black text-indigo-900 mb-12 text-center">
                {{ auth()->user()->currentFacility->name }} Dashboard
            </h1>
        @else
            <div class="bg-yellow-50 border-l-8 border-yellow-600 rounded-2xl p-12 text-center mb-12">
                <h1 class="text-5xl font-black text-indigo-900 mb-8">
                    Welcome, {{ auth()->user()->name }}!
                </h1>
                <p class="text-3xl text-gray-800 mb-12">
                    You haven't selected a facility yet.
                </p>
                <a href="{{ route('facility.overview') }}" 
                   class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-16 py-8 rounded-2xl text-3xl font-black shadow-2xl transition transform hover:scale-105 inline-block">
                    Choose Your Facility ?
                </a>
            </div>
        @endif

        @if(auth()->user()->currentFacility)
            @livewire('compliance-score-card')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                @livewire('ai-assistant.recommendations')
                @livewire('tasks.upcoming')
                @livewire('pool.latest-tests')
            </div>
        @endif
    </div>
</x-app-layout>