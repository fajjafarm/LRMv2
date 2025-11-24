{{-- 007 resources/views/livewire/pool/pool-test-form.blade.php --}}
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-3xl font-bold mb-6">Record Pool Test – {{ $subFacility->name }}</h2>

    <form wire:submit.prevent="save">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block font-medium">Temperature (°C)</label>
                <input type="number" step="0.1" wire:model="temperature" class="w-full border rounded-lg px-4 py-2" required>
            </div>
            <div>
                <label class="block font-medium">Free Chlorine (ppm)</label>
                <input type="number" step="0.1" wire:model="free_chlorine" class="w-full border rounded-lg px-4 py-2" required>
            </div>
            <div>
                <label class="block font-medium">pH</label>
                <input type="number" step="0.01" wire:model="ph" class="w-full border rounded-lg px-4 py-2" required>
            </div>
            <div>
                <label class="block font-medium">Total Alkalinity</label>
                <input type="number" step="0.1" wire:model="alkalinity" class="w-full border rounded-lg px-4 py-2">
            </div>
        </div>

        <div class="mt-6">
            <label class="block font-medium">Notes</label>
            <textarea wire:model="notes" class="w-full border rounded-lg px-4 py-2" rows="3"></textarea>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-indigo-700">
                Save Test Result
            </button>
        </div>
    </form>
</div>