<div class="space-y-8">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">
                    Service Scheduler
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 mt-2">
                    Schedule maintenance for pumps, filters, injectors & equipment
                </p>
            </div>
            <button wire:click="$set('showCreateModal', true)" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-xl font-bold shadow-lg transition">
                + Schedule Service
            </button>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
                <div class="text-4xl font-bold text-blue-600 dark:text-blue-400">{{ $totalServices }}</div>
                <div class="text-gray-700 dark:text-gray-300 mt-2">Total Services</div>
            </div>
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-6">
                <div class="text-4xl font-bold text-green-600 dark:text-green-400">{{ $completedThisMonth }}</div>
                <div class="text-gray-700 dark:text-gray-300 mt-2">Completed</div>
            </div>
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-6">
                <div class="text-4xl font-bold text-yellow-600 dark:text-yellow-400">{{ $dueSoon }}</div>
                <div class="text-gray-700 dark:text-gray-300 mt-2">Due Soon</div>
            </div>
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-6">
                <div class="text-4xl font-bold text-red-600 dark:text-red-400">{{ $overdue }}</div>
                <div class="text-gray-700 dark:text-gray-300 mt-2">OVERDUE</div>
            </div>
        </div>
    </div>

    <!-- Service Calendar (Month View) -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
        <div class="p-8 border-b dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Upcoming Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($upcomingServices as $service)
                    @php
                        $isOverdue = $service->next_due && $service->next_due->isPast();
                        $daysUntil = $service->next_due ? $service->next_due->diffInDays() : null;
                    @endphp
                    <div class="group relative bg-gradient-to-br {{ $isOverdue ? 'from-red-50 to-red-100' : 'from-indigo-50 to-purple-50' }} dark:from-gray-700 dark:to-gray-800 rounded-xl p-6 border-2 {{ $isOverdue ? 'border-red-300' : 'border-indigo-300' }} hover:shadow-lg transition">
                        <div class="absolute -top-4 left-6">
                            <span class="bg-{{ $isOverdue ? 'red' : 'indigo' }}-600 text-white px-4 py-2 rounded-full text-sm font-bold">
                                {{ $isOverdue ? 'OVERDUE' : ($daysUntil <= 7 ? 'DUE SOON' : 'ON TRACK') }}
                            </span>
                        </div>

                        <div class="flex items-start justify-between mb-4">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">
                                {{ $service->title }}
                            </h3>
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $service->frequency === 'monthly' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $service->frequency === 'quarterly' ? 'bg-purple-100 text-purple-800' : '' }}
                                {{ $service->frequency === 'annually' ? 'bg-indigo-100 text-indigo-800' : '' }}">
                                {{ ucfirst($service->frequency) }}
                            </span>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Equipment</span>
                                <span class="font-medium">{{ $service->schedulable->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Next Due</span>
                                <span class="font-bold {{ $isOverdue ? 'text-red-600' : 'text-indigo-600' }}">
                                    {{ $service->next_due?->format('d M Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Last Completed</span>
                                <span>{{ $service->last_completed?->format('d M Y') ?? 'Never' }}</span>
                            </div>
                        </div>

                        <div class="flex space-x-3 pt-4">
                            <button wire:click="logService({{ $service->id }})" 
                                    class="flex-1 bg-{{ $isOverdue ? 'red' : 'green' }}-600 hover:bg-{{ $isOverdue ? 'red' : 'green' }}-700 text-white py-3 rounded-xl font-bold transition">
                                {{ $isOverdue ? 'Log Overdue Service' : 'Log Service' }}
                            </button>
                            <button wire:click="editService({{ $service->id }})" 
                                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold transition">
                                Edit
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-2xl text-gray-500 dark:text-gray-400">No services scheduled</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Create/Edit Service Modal -->
    @if($showCreateModal || $editingService)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-4xl w-full max-h-screen overflow-y-auto">
                <div class="p-8">
                    <h2 class="text-3xl font-bold mb-8">
                        {{ $editingService ? 'Edit' : 'Schedule New' }} Service
                    </h2>

                    <form wire:submit.prevent="{{ $editingService ? 'updateService' : 'createService' }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <!-- Equipment Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Equipment *</label>
                                <select wire:model="equipmentId" class="w-full border-2 rounded-xl px-6 py-4" required>
                                    <option value="">Select equipment...</option>
                                    @foreach($equipment as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->type }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Service Title -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Service Title *</label>
                                <input type="text" wire:model="title" class="w-full border-2 rounded-xl px-6 py-4" required placeholder="e.g. Quarterly Filter Service">
                            </div>

                            <!-- Frequency -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Frequency *</label>
                                <select wire:model="frequency" class="w-full border-2 rounded-xl px-6 py-4" required>
                                    <option value="">Select frequency...</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="semi-annual">Semi-Annual</option>
                                    <option value="annually">Annually</option>
                                </select>
                            </div>

                            <!-- Interval -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Interval (e.g. every 3 months)</label>
                                <input type="number" wire:model="interval" class="w-full border-2 rounded-xl px-6 py-4" min="1" max="12">
                            </div>

                            <!-- Start Date -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">First Service Date *</label>
                                <input type="date" wire:model="startDate" class="w-full border-2 rounded-xl px-6 py-4" required>
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Service Description</label>
                                <textarea wire:model="description" rows="4" class="w-full border-2 rounded-xl px-6 py-4" placeholder="Detailed instructions for technicians: what to check, parts to replace, pressure readings to record..."></textarea>
                            </div>
                        </div>

                        <div class="mt-12 flex justify-end space-x-6">
                            <button type="button" wire:click="$set('showCreateModal', false); $set('editingService', null)" 
                                    class="px-10 py-5 border-2 border-gray-300 dark:border-gray-600 rounded-xl font-bold hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-12 py-5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-bold text-xl shadow-2xl hover:shadow-indigo-500/50 transition">
                                {{ $editingService ? 'Update Schedule' : 'Create Schedule' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

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
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Notes / Findings *</label>
                                <textarea wire:model="notes" rows="6" class="w-full border-2 rounded-xl px-6 py-4" required placeholder="Describe work completed, pressure readings, parts replaced, any issues found..."></textarea>
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