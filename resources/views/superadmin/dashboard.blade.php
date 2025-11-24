<x-app-layout>
<div class="max-w-7xl mx-auto py-12">
    <h1 class="text-7xl font-black text-indigo-900 text-center mb-16">SUPER ADMIN CONTROL</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        <!-- Add Business -->
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl p-12 text-white text-center shadow-2xl hover:shadow-3xl transition">
            <div class="text-9xl mb-8">🏢</div>
            <h2 class="text-4xl font-black mb-6">Add New Customer</h2>
            <a href="{{ route('admin.businesses.create') }}" 
               class="bg-white text-indigo-600 px-16 py-8 rounded-2xl text-3xl font-black inline-block hover:scale-105 transition">
                + New Business
            </a>
        </div>

        <!-- View All Businesses -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-3xl p-12 text-white text-center shadow-2xl hover:shadow-3xl transition">
            <div class="text-9xl mb-8">👥</div>
            <h2 class="text-4xl font-black mb-6">All Customers</h2>
            <a href="{{ route('admin.businesses.index') }}" 
               class="bg-white text-green-600 px-16 py-8 rounded-2xl text-3xl font-black inline-block hover:scale-105 transition">
                {{ \App\Models\Business::count() }} Active
            </a>
        </div>

        <!-- Revenue -->
        <div class="bg-gradient-to-br from-yellow-500 to-orange-600 rounded-3xl p-12 text-white text-center shadow-2xl hover:shadow-3xl transition">
            <div class="text-9xl mb-8">💷</div>
            <h2 class="text-4xl font-black mb-6">Monthly Revenue</h2>
            <p class="text-8xl font-black">
                £{{ number_format(\App\Models\Business::sum('monthly_price'), 0) }}
            </p>
        </div>
    </div>

    <div class="text-center mt-24">
        <p class="text-4xl text-gray-700">You control the entire British leisure compliance empire</p>
        <p class="text-8xl mt-8">🇬🇧👑</p>
    </div>
</div>
</x-app-layout>