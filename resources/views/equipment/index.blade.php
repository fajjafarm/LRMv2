{{-- 001 resources/views/equipment/index.blade.php --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <h1 class="text-6xl font-black text-indigo-900 text-center mb-12">Equipment Register</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <div class="bg-blue-50 rounded-3xl p-10 text-center">
                <p class="text-8xl font-black text-blue-600">{{ $total }}</p>
                <p class="text-3xl font-bold mt-4">Total Items</p>
            </div>
            <div class="bg-green-50 rounded-3xl p-10 text-center">
                <p class="text-8xl font-black text-green-600">{{ $inService }}</p>
                <p class="text-3xl font-bold mt-4">In Service</p>
            </div>
            <div class="bg-yellow-50 rounded-3xl p-10 text-center">
                <p class="text-8xl font-black text-yellow-600">{{ $dueSoon }}</p>
                <p class="text-3xl font-bold mt-4">Due Soon</p>
            </div>
            <div class="bg-red-50 rounded-3xl p-10 text-center">
                <p class="text-8xl font-black text-red-600">{{ $overdue }}</p>
                <p class="text-3xl font-bold mt-4">OVERDUE</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-8">
                <h2 class="text-4xl font-black">All Equipment</h2>
            </div>
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-8 py-6 text-left text-xl font-bold">Name</th>
                        <th class="px-8 py-6 text-left text-xl font-bold">Type</th>
                        <th class="px-8 py-6 text-left text-xl font-bold">Location</th>
                        <th class="px-8 py-6 text-left text-xl font-bold">Next Service</th>
                        <th class="px-8 py-6 text-left text-xl font-bold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($equipment as $item)
                        @php $next = $item->nextServiceDue() @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-8 py-6 text-xl font-bold">{{ $item->name }}</td>
                            <td class="px-8 py-6">
                                <span class="px-6 py-3 rounded-full text-lg font-bold bg-indigo-100 text-indigo-800">
                                    {{ ucfirst($item->type) }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-xl">{{ $item->subFacility->name }}</td>
                            <td class="px-8 py-6 text-xl">
                                {{ $next?->format('d M Y') ?? '—' }}
                            </td>
                            <td class="px-8 py-6">
                                @if($next?->isPast())
                                    <span class="bg-red-100 text-red-800 px-8 py-4 rounded-full text-2xl font-bold">
                                        OVERDUE
                                    </span>
                                @elseif($next?->diffInDays() <= 30)
                                    <span class="bg-yellow-100 text-yellow-800 px-8 py-4 rounded-full text-2xl font-bold">
                                        DUE SOON
                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-800 px-8 py-4 rounded-full text-2xl font-bold">
                                        GOOD
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>