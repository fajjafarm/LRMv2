{{-- 001 resources/views/training/compliance.blade.php --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <h1 class="text-6xl font-black text-indigo-900 text-center mb-12">
            Training Compliance Dashboard
        </h1>

        @livewire('training.compliance-score')

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-8">
                <h2 class="text-4xl font-black">All Staff Qualifications</h2>
            </div>
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-8 py-6 text-left text-xl font-bold">Staff</th>
                        <th class="px-8 py-6 text-left text-xl font-bold">Qualification</th>
                        <th class="px-8 py-6 text-left text-xl font-bold">Expiry</th>
                        <th class="px-8 py-6 text-left text-xl font-bold">Hours This Month</th>
                        <th class="px-8 py-6 text-left text-xl font-bold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($staff as $user)
                        @foreach($user->qualifications as $uq)
                            @php
                                $daysLeft = $uq->expiry_date?->diffInDays() ?? 999;
                                $hours = $uq->trainingHours()->whereMonth('training_date', now()->month)->sum('hours');
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-8 py-6 text-xl">{{ $user->name }}</td>
                                <td class="px-8 py-6 text-xl">{{ $uq->qualification->name }}</td>
                                <td class="px-8 py-6 text-xl {{ $daysLeft <= 30 ? 'text-red-600 font-bold' : '' }}">
                                    {{ $uq->expiry_date?->format('d M Y') ?? 'No expiry' }}
                                </td>
                                <td class="px-8 py-6 text-xl">
                                    <span class="{{ $hours >= 2 ? 'text-green-600' : 'text-red-600' }} font-bold">
                                        {{ $hours }}/2
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    @if($daysLeft <= 30 || $hours < 2)
                                        <span class="bg-red-100 text-red-800 px-8 py-4 rounded-full text-2xl font-bold">
                                            ACTION REQUIRED
                                        </span>
                                    @else
                                        <span class="bg-green-100 text-green-800 px-8 py-4 rounded-full text-2xl font-bold">
                                            COMPLIANT
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>