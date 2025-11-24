<x-app-layout>
    <div class="max-w-2xl mx-auto py-20">
        <h1 class="text-5xl font-black text-indigo-900 mb-12">Add Facility to {{ $business->name }}</h1>
        <form method="POST" action="{{ route('admin.businesses.facilities.store', $business) }}" class="bg-white rounded-3xl shadow-2xl p-12">
            @csrf
            <input type="text" name="name" placeholder="Facility Name" required class="w-full border-4 border-indigo-300 rounded-2xl px-8 py-6 text-2xl mb-8">
            <button class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-20 py-10 rounded-2xl text-4xl font-black w-full">
                Create Facility
            </button>
        </form>
    </div>
</x-app-layout>