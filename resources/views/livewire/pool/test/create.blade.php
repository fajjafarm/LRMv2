{{-- 001 resources/views/pool/test/create.blade.php --}}
<x-app-layout>
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-3xl shadow-2xl p-12">
            <h1 class="text-4xl font-black text-indigo-900 mb-8 text-center">
                Record Pool Test – {{ $subFacility->name }}
            </h1>

            <form wire:submit.prevent="save" class="space-y-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xl font-bold mb-4">Temperature (°C)</label>
                        <input type="number" step="0.1" wire:model="temperature" class="w-full border-4 border-indigo-200 rounded-2xl px-8 py-6 text-2xl" required>
                    </div>
                    <div>
                        <label class="block text-xl font-bold mb-4">Free Chlorine (ppm)</label>
                        <input type="number" step="0.1" wire:model="free_chlorine" class="w-full border-4 border-indigo-200 rounded-2xl px-8 py-6 text-2xl" required>
                    </div>
                    <div>
                        <label class="block text-xl font-bold mb-4">pH Level</label>
                        <input type="number" step="0.01" wire:model="ph" class="w-full border-4 border-indigo-200 rounded-2xl px-8 py-6 text-2xl" required>
                    </div>
                    <div>
                        <label class="block text-xl font-bold mb-4">Total Alkalinity</label>
                        <input type="number" step="0.1" wire:model="alkalinity" class="w-full border-4 border-indigo-200 rounded-2xl px-8 py-6 text-2xl">
                    </div>
                </div>

                <div>
                    <label class="block text-xl font-bold mb-4">Notes</label>
                    <textarea wire:model="notes" rows="6" class="w-full border-4 border-indigo-200 rounded-2xl px-8 py-6 text-xl"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" 
                            class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-16 py-8 rounded-2xl text-3xl font-black shadow-2xl transition transform hover:scale-105">
                        Save Test Result
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>