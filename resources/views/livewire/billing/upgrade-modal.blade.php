<div x-data="{ open: @entangle('show') }" x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div @click.away="$wire.show = false" class="bg-white rounded-3xl shadow-2xl p-12 max-w-2xl mx-4">
        <h2 class="text-5xl font-black text-indigo-900 mb-8 text-center">Upgrade Your Plan</h2>
        <p class="text-2xl text-gray-700 text-center mb-12">
            Unlock ERMES sync, AI Assistant, Parent Portal & more
        </p>
        <div class="text-center">
            <button @click="$wire.show = false" class="bg-gray-600 hover:bg-gray-700 text-white px-16 py-8 rounded-2xl text-3xl font-bold">
                Close
            </button>
        </div>
    </div>
</div>