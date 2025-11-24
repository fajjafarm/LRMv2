<x-app-layout>
    <div class="max-w-4xl mx-auto py-20">
        <h1 class="text-6xl font-black text-indigo-900 text-center mb-12">
            Add Sub-Facility to {{ $facility->name }}
        </h1>

        <form method="POST" action="{{ route('admin.facilities.sub.store', $facility) }}" 
              class="bg-white rounded-3xl shadow-2xl p-16 space-y-12">
            @csrf

            <div>
                <label class="block text-3xl font-bold text-gray-800 mb-6">Name</label>
                <input type="text" name="name" required 
                       class="w-full border-4 border-indigo-300 rounded-2xl px-10 py-8 text-3xl"
                       placeholder="e.g. Main Pool, Spa Pool, Training Pool">
            </div>

            <div>
                <label class="block text-3xl font-bold text-gray-800 mb-6">Type</label>
                <select name="type" required class="w-full border-4 border-indigo-300 rounded-2xl px-10 py-8 text-3xl">
                    <option>Main Pool</option>
                    <option>Learner Pool</option>
                    <option>Spa / Hydrotherapy</option>
                    <option>Outdoor Pool</option>
                    <option>Plunge Pool</option>
                </select>
            </div>

            <div>
                <label class="block text-3xl font-bold text-gray-800 mb-6">Check Interval (minutes)</label>
                <input type="number" name="check_interval_minutes" value="120" 
                       class="w-full border-4 border-indigo-300 rounded-2xl px-10 py-8 text-3xl"
                       placeholder="e.g. 120 = every 2 hours">
            </div>

            <div class="text-center">
                <button type="submit" 
                        class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-32 py-16 rounded-3xl text-5xl font-black shadow-2xl transition transform hover:scale-105">
                    Create Sub-Facility
                </button>
            </div>
        </form>
    </div>
</x-app-layout>