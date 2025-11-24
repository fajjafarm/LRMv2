{{-- 009 resources/views/livewire/billing/upgrade-modal.blade.php --}}
<div>
    <button wire:click="$toggle('showModal')" class="bg-green-600 text-white px-6 py-3 rounded-lg font-bold">
        Upgrade Plan
    </button>

    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white rounded-xl p-8 max-w-md w-full">
                <h2 class="text-2xl font-bold mb-4">Upgrade Your LRM Plan</h2>
                <p class="mb-6">Add powerful modules to your subscription</p>

                <div class="space-y-4">
                    <label class="flex items-center">
                        <input type="checkbox" wire:model="modules" value="ermes" class="mr-3">
                        <span>ERMES Pump Integration (+£49/mo)</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" wire:model="modules" value="training_plus" class="mr-3">
                        <span>Advanced Training Module (+£29/mo)</span>
                    </label>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <button wire:click="$set('showModal', false)" class="text-gray-600 font-medium">Cancel</button>
                    <button wire:click="upgrade" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold">
                        Upgrade Now
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>