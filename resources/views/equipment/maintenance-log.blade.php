<div class="max-w-6xl mx-auto space-y-8">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">
                    Maintenance Log – {{ $equipment->name }}
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 mt-2">
                    {{ $equipment->type }} • {{ $equipment->subFacility->name }}
                </p>
            </div>
            <div class="text-right">
                <div class="text-5xl font-bold text-indigo-600">
                    {{ $equipment->serviceSchedules->where('is_completed', false)->count() }}
                </div>
                <div class="text-gray-600 dark:text-gray-400">Upcoming Services</div>
            </div>
        </div>

        <!-- Equipment Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
                <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $totalServices }}</div>
                <div class="text-gray-700 dark:text-gray-300 mt-2">Total Services</div>
            </div>
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-6">
                <div class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $completedOnTime }}</div>
                <div class="text-gray-700 dark:text-gray-300 mt-2">On Time</div>
            </div>
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-6">
                <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $completedLate }}</div>
                <div class="text-gray-700 dark:text-gray-300 mt-2">Late</div>
            </div>
            <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-xl p-6">
                <div class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $averageInterval }} days</div>
                <div class="text-gray-700 dark:text-gray-300 mt-2">Avg. Interval</div>
            </div>
        </div>

        <!-- Next Service Alert -->
        @if($nextService = $equipment->nextServiceDue())
            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 border-2 border-indigo-300 dark:border-indigo-700 rounded-2xl p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-indigo-900 dark:text-indigo-300">
                            Next Service Due
                        </h3>
                        <p class="text-4xl font-bold text-indigo-700 dark:text-indigo-200 mt-2">
                            {{ $nextService->format('l j F Y') }}
                        </p>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mt-2">
                            {{ $nextService->diffForHumans() }}
                        </p>
                    </div>
                    <div>
                        @if($nextService->isPast())
                            <span class="bg-red-100 text-red-800 px-8 py-4 rounded-full text-2xl font-bold">OVERDUE</span>
                        @elseif($nextService->diffInDays() <= 30)
                            <span class="bg-yellow-100 text-yellow-800 px-8 py-4 rounded-full text-2xl font-bold">DUE SOON</span>
                        @else
                            <span class="bg-green-100 text-green-800 px-8 py-4 rounded-full text-2xl font-bold">ON TRACK</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Log Service Button -->
        <div class="text-right mb-8">
            <button wire:click="$set('showLogModal', true)" 
                    class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-10 py-5 rounded-xl font-bold text-xl shadow-2xl transition transform hover:scale-105">
                Log Completed Service
            </button>
        </div>

        <!-- Maintenance History Table -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow overflow-hidden">
            <div class="p-6 border-b dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Maintenance History</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Performed By</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Type</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Details</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Next Due</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($maintenanceLog as $log)
                            @php
                                $wasLate = $log->completed_at && $log->next_due && $log->completed_at->gt($log->next_due);
                            @endphp
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 font-medium">
                                    {{ $log->completed_at?->format('d M Y') ?? '—' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $log->completedBy?->name ?? '—' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-4 py-2 rounded-full text-sm font-bold
                                        {{ $log->frequency === 'monthly' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $log->frequency === 'quarterly' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ $log->frequency === 'annually' ? 'bg-indigo-100 text-indigo-800' : '' }}">
                                        {{ ucfirst($log->frequency) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ Str::limit($log->description, 100) }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($wasLate)
                                        <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full font-bold">LATE</span>
                                    @else
                                        <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-bold">ON TIME</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $log->nextService?->next_due?->format('d M Y') ?? '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-16 text-gray-500 dark:text-gray-400">
                                    No maintenance records yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Log Service Modal -->
    @if($showLogModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-2xl w-full">
                <div class="p-8">
                    <h2 class="text-3xl font-bold mb-8">Log Completed Service</h2>

                    <form wire:submit.prevent="logService">
                        <div class="space-y-8">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Service Date *</label>
                                <input type="date" wire:model="serviceDate" class="w-full border-2 rounded-xl px-6 py-4" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Performed By *</label>
                                <select wire:model="performedBy" class="w-full border-2 rounded-xl px-6 py-4" required>
                                    <option value="">Select staff member...</option>
                                    @foreach($staff as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Service Type</label>
                                <select wire:model="serviceType" class="w-full border-2 rounded-xl px-6 py-4">
                                    <option>Routine Maintenance</option>
                                    <option>Repair</option>
                                    <option>Inspection</option>
                                    <option>Calibration</option>
                                    <option>Replacement</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Details / Notes *</label>
                                <textarea wire:model="notes" rows="6" class="w-full border-2 rounded-xl px-6 py-4" required placeholder="Describe work completed, parts replaced, findings..."></textarea>
                            </div>
                        </div>

                        <div class="mt-12 flex justify-end space-x-6">
                            <button type="button" wire:click="$set('showLogModal', false)" 
                                    class="px-10 py-5 border-2 border-gray-300 dark:border-gray-600 rounded-xl font-bold hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-12 py-5 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl font-bold text-xl shadow-2xl hover:shadow-green-500/50 transition">
                                Log Service Completed
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>