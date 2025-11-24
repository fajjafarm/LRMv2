{{-- 008 resources/views/livewire/import/palintest-import.blade.php --}}
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6">Import Palintest Data</h2>

    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="import" class="space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Select Pool / Sub-Facility
            </label>
            <select wire:model="subFacilityId" class="w-full border rounded-lg px-4 py-2" required>
                <option value="">Choose...</option>
                @foreach(auth()->user()->currentFacility->subFacilities as $sf)
                    <option value="{{ $sf->id }}">{{ $sf->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Palintest CSV File
            </label>
            <input type="file" wire:model="file" accept=".csv,.txt" class="w-full" required>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-indigo-700">
            Import Palintest Data
        </button>
    </form>
</div>