{{-- 003 resources/views/palintest/import.blade.php --}}
<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-3xl shadow-2xl p-12">
            <h1 class="text-5xl font-black text-indigo-900 text-center mb-12">
                Palintest Import
            </h1>

            @if(session('success'))
                <div class="bg-green-100 border-4 border-green-500 text-green-800 px-12 py-8 rounded-2xl text-2xl font-bold text-center mb-12">
                    {{ session('success') }}
                </div>
            @endif

            <form wire:submit.prevent="import" class="space-y-12">
                <div>
                    <label class="block text-2xl font-bold mb-6">Select Pool</label>
                    <select wire:model="subFacilityId" class="w-full border-4 border-indigo-300 rounded-2xl px-8 py-6 text-xl" required>
                        <option value="">Choose pool...</option>
                        @foreach($subFacilities as $sf)
                            <option value="{{ $sf->id }}">{{ $sf->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-2xl font-bold mb-6">Upload CSV File</label>
                    <input type="file" wire:model="file" accept=".csv" class="w-full border-4 border-indigo-300 rounded-2xl px-8 py-6 text-xl" required>
                </div>

                <div class="text-center">
                    <button type="submit" 
                            class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-20 py-10 rounded-2xl text-4xl font-black shadow-2xl transition transform hover:scale-105">
                        Import Palintest Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>