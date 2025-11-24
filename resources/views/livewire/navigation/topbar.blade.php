{{-- 003 resources/views/livewire/navigation/topbar.blade.php --}}
<div class="bg-white dark:bg-gray-800 shadow-lg px-6 py-4 flex justify-between items-center">
    <div class="flex items-center space-x-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ auth()->user()->currentFacility?->name ?? 'Select Facility' }}
        </h2>
        @if(auth()->user()->current_facility_id)
            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-bold">
                Compliance: {{ auth()->user()->currentFacility->complianceScore ?? 0 }}/100
            </span>
        @endif
    </div>
    <div class="flex items-center space-x-6">
        @livewire('ai-assistant.mini')
        <div class="text-right">
            <p class="text-sm text-gray-600 dark:text-gray-400">Welcome back</p>
            <p class="font-bold">{{ auth()->user()->name }}</p>
        </div>
    </div>
</div>