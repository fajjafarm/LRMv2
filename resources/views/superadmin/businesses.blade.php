<x-app-layout>
    <div class="max-w-7xl mx-auto py-12">
        <h1 class="text-6xl font-black text-indigo-900 text-center mb-12">All Customers</h1>
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <table class="w-full">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-8 py-6 text-left text-2xl">Business</th>
                        <th class="px-8 py-6 text-center text-2xl">Facilities</th>
                        <th class="px-8 py-6 text-center text-2xl">Revenue</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($businesses as $business)
                    <tr class="hover:bg-gray-50">
                        <td class="px-8 py-6 text-xl font-bold">{{ $business->name }}</td>
                        <td class="px-8 py-6 text-center text-3xl">{{ $business->facilities_count }}</td>
                        <td class="px-8 py-6 text-center text-3xl font-bold text-green-600">
                            £{{ number_format($business->monthly_price, 0) }}/mo
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>