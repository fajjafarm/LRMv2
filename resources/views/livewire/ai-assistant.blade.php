{{-- 001 resources/views/livewire/ai-assistant.blade.php --}}
<div class="max-w-7xl mx-auto">
    <div class="bg-gradient-to-br from-indigo-600 via-purple-700 to-pink-600 rounded-3xl p-16 text-white text-center shadow-2xl">
        <h1 class="text-7xl font-black mb-8">Good Morning, {{ auth()->user()->name }}!</h1>
        <p class="text-4xl opacity-90">Your AI Assistant has analyzed everything overnight</p>
        <p class="text-5xl font-bold mt-12">Here are your TOP priorities today:</p>
    </div>

    @if($critical->count())
        <div class="mt-16">
            <h2 class="text-6xl font-black text-red-600 text-center mb-12">CRITICAL – DO NOW</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                @foreach($critical as $rec)
                    <div class="bg-red-50 border-8 border-red-600 rounded-3xl p-12 hover:shadow-2xl transition">
                        <h3 class="text-4xl font-black text-red-900 mb-6">{{ $rec->title }}</h3>
                        <p class="text-2xl text-red-800 mb-8">{{ $rec->description }}</p>
                        <div class="flex space-x-6">
                            <button wire:click="dismiss({{ $rec->id }})" 
                                    class="flex-1 bg-red-600 hover:bg-red-700 text-white py-8 rounded-2xl text-3xl font-black">
                                I've Done This
                            </button>
                            <button wire:click="createTask({{ $rec->id }})" 
                                    class="bg-gray-800 hover:bg-gray-900 text-white py-8 rounded-2xl text-3xl font-black">
                                Assign Task
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($high->count())
        <div class="mt-16">
            <h2 class="text-5xl font-black text-orange-600 text-center mb-12">HIGH PRIORITY</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($high as $rec)
                    <div class="bg-orange-50 border-4 border-orange-600 rounded-3xl p-10">
                        <h3 class="text-3xl font-bold text-orange-900 mb-4">{{ $rec->title }}</h3>
                        <p class="text-xl text-orange-800 mb-8">{{ $rec->description }}</p>
                        <button wire:click="dismiss({{ $rec->id }})" 
                                class="w-full bg-orange-600 hover:bg-orange-700 text-white py-6 rounded-2xl text-2xl font-bold">
                            Mark Done
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($recommendations->where('dismissed', false)->count() === 0)
        <div class="text-center py-32">
            <div class="text-9xl mb-12">🎉</div>
            <h2 class="text-7xl font-black text-green-600">PERFECT COMPLIANCE!</h2>
            <p class="text-4xl text-gray-700 mt-12">Everything is 100% on track today.</p>
        </div>
    @endif
</div>