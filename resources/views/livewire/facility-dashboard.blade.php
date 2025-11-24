{{-- 006 resources/views/livewire/facility-dashboard.blade.php --}}
<div class="p-8">
    <h1 class="text-4xl font-bold mb-8">{{ auth()->user()->currentFacility->name }} Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-blue-50 p-6 rounded-xl">
            <h3 class="text-lg font-bold">Today's Tests</h3>
            <p class="text-4xl font-bold text-blue-600">{{ $todayTests }}</p>
        </div>
        <div class="bg-green-50 p-6 rounded-xl">
            <h3 class="text-lg font-bold">In Range</h3>
            <p class="text-4xl font-bold text-green-600">{{ $inRange }}</p>
        </div>
        <div class="bg-red-50 p-6 rounded-xl">
            <h3 class="text-lg font-bold">Out of Range</h3>
            <p class="text-4xl font-bold text-red-600">{{ $outOfRange }}</p>
        </div>
        <div class="bg-purple-50 p-6 rounded-xl">
            <h3 class="text-lg font-bold">Tasks Due</h3>
            <p class="text-4xl font-bold text-purple-600">{{ $dueTasks }}</p>
        </div>
    </div>

    @livewire('tasks.task-manager')
</div>