{{-- 002 resources/views/training/scheduler.blade.php --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <h1 class="text-6xl font-black text-indigo-900 text-center mb-12">Training Scheduler</h1>

        @livewire('training.scheduler-calendar')

        <div class="text-center mt-16">
            <button wire:click="$set('showCreateModal', true)" 
                    class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-20 py-12 rounded-3xl text-5xl font-black shadow-2xl transition transform hover:scale-105">
                + Schedule New Training
            </button>
        </div>
    </div>
</x-app-layout>