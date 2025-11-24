<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="flex items-center space-x-3 text-white hover:bg-indigo-800 px-4 py-3 rounded-lg transition">
        <span class="font-medium">
            {{ $current?->name ?? 'Select Facility' }}
        </span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div x-show="open" @click.away="open = false" class="absolute top-full mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
        @foreach($facilities as $facility)
            <a href="{{ route('facility.switch', $facility) }}"
               class="block px-6 py-4 text-gray-800 hover:bg-indigo-50 {{ $current?->id == $facility->id ? 'bg-indigo-100 font-bold' : '' }}">
                transition">
                {{ $facility->name }}
            </a>
        @endforeach
    </div>
</div>