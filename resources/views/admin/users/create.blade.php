<x-app-layout>
    <div class="max-w-4xl mx-auto py-20">
        <h1 class="text-6xl font-black text-indigo-900 text-center mb-12">
            Add User to {{ $business->name }}
        </h1>

        <form method="POST" action="{{ route('admin.businesses.users.store', $business) }}" 
              class="bg-white rounded-3xl shadow-2xl p-16 space-y-12">
            @csrf

            <div>
                <label class="block text-3xl font-bold text-gray-800 mb-6">Full Name</label>
                <input type="text" name="name" required 
                       class="w-full border-4 border-indigo-300 rounded-2xl px-10 py-8 text-3xl"
                       placeholder="John Smith">
            </div>

            <div>
                <label class="block text-3xl font-bold text-gray-800 mb-6">Email</label>
                <input type="email" name="email" required 
                       class="w-full border-4 border-indigo-300 rounded-2xl px-10 py-8 text-3xl"
                       placeholder="john@site.com">
            </div>

            <div>
                <label class="block text-3xl font-bold text-gray-800 mb-6">Password</label>
                <input type="password" name="password" required minlength="8"
                       class="w-full border-4 border-indigo-300 rounded-2xl px-10 py-8 text-3xl">
            </div>

            <div>
                <label class="block text-3xl font-bold text-gray-800 mb-6">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full border-4 border-indigo-300 rounded-2xl px-10 py-8 text-3xl">
            </div>

            <div class="text-center">
                <button type="submit" 
                        class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-32 py-16 rounded-3xl text-5xl font-black shadow-2xl transition transform hover:scale-105">
                    Add User
                </button>
            </div>
        </form>
    </div>
</x-app-layout>