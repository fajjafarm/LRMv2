<aside class="w-64 bg-indigo-900 text-white min-h-screen p-4 overflow-y-auto">
    <div class="p-6">
        <h1 class="text-4xl font-black tracking-wider">LRM</h1>
        <p class="text-sm opacity-80 mt-2">Leisure Resource Manager</p>
    </div>

    <nav class="space-y-2">
        <a href="{{ route('dashboard') }}" 
           class="block px-6 py-4 hover:bg-indigo-800 rounded-r-lg text-lg font-medium transition {{ request()->routeIs('dashboard') ? 'bg-indigo-700' : '' }}">
            Dashboard
        </a>

        @if(auth()->user()->current_facility_id)
            <a href="{{ route('tasks.index') }}" 
               class="block px-6 py-4 hover:bg-indigo-800 rounded-r-lg text-lg font-medium transition flex justify-between items-center">
                <span>Tasks</span>
                @if(auth()->user()->openTasks()->count() > 0)
                    <span class="bg-red-600 text-xs px-2 py-1 rounded-full">
                        {{ auth()->user()->openTasks()->count() }}
                    </span>
                @endif
            </a>

            <a href="{{ route('pool.tests') }}" class="block px-6 py-4 hover:bg-indigo-800 rounded-r-lg text-lg font-medium transition">Pool Testing</a>
            <a href="{{ route('training.compliance') }}" class="block px-6 py-4 hover:bg-indigo-800 rounded-r-lg text-lg font-medium transition">Training</a>
            <a href="{{ route('coshh.index') }}" class="block px-6 py-4 hover:bg-indigo-800 rounded-r-lg text-lg font-medium transition">COSHH & PPE</a>
            <a href="{{ route('equipment.index') }}" class="block px-6 py-4 hover:bg-indigo-800 rounded-r-lg text-lg font-medium transition">Equipment</a>
            <a href="{{ route('palintest.import') }}" class="block px-6 py-4 hover:bg-indigo-800 rounded-r-lg text-lg font-medium transition">Palintest Import</a>

            {{-- Only show ERMES if business exists AND has the module --}}
            @if(auth()->user()->business && auth()->user()->business->hasModule('ermes'))
                <a href="/ermes" class="block px-6 py-4 hover:bg-indigo-800 rounded-r-lg text-lg font-medium transition">ERMES Pumps</a>
            @endif

            <div class="border-t border-indigo-700 mt-6 pt-6">
                <h3 class="text-sm font-bold text-indigo-300 uppercase tracking-wider mb-4">Sub-Facilities</h3>
                @foreach(auth()->user()->currentFacility?->subFacilities ?? [] as $sub)
                    <div class="px-6 py-3 bg-indigo-800 rounded-lg mb-2 flex justify-between items-center">
                        <span class="text-sm">{{ $sub->name }}</span>
                        @if($sub->requires_check && $sub->needsCheck())
                            <span class="bg-red-600 text-xs px-2 py-1 rounded">Check Due!</span>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        @if(auth()->user()->is_super_admin)
            <div class="border-t border-indigo-700 mt-8 pt-8">
                <div class="px-6 text-sm font-bold text-indigo-300 uppercase tracking-wider mb-4">Super Admin</div>
                <a href="{{ route('admin.businesses.index') }}" class="block px-6 py-4 hover:bg-indigo-800 rounded-r-lg text-lg font-medium transition">
                    All Customers
                </a>
            </div>
        @endif
    </nav>

    <div class="p-6 mt-auto">
        <div class="bg-indigo-800 rounded-2xl p-6 text-center">
            <p class="text-4xl">🇬🇧</p>
            <p class="text-xs mt-4 opacity-80">The new British standard</p>
        </div>
    </div>
</aside>