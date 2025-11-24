{{-- resources/views/livewire/nop-eap-wizard.blade.php --}}
<div class="max-w-5xl mx-auto space-y-12">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-10">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-indigo-900 dark:text-indigo-300">
                {{ $template->name }} Generator
            </h1>
            <p class="text-2xl text-gray-600 dark:text-gray-400 mt-4">
                Answer 15 questions → get a perfect, HSE-compliant document
            </p>
        </div>

        <form wire:submit.prevent="generate">
            <div class="space-y-12">
                @foreach($template->variables as $var)
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-800 rounded-2xl p-8">
                        <label class="block text-xl font-bold text-indigo-900 dark:text-indigo-300 mb-6">
                            {{ $var['question'] }}
                        </label>

                        @if($var['type'] === 'text')
                            <input type="text" wire:model="answers.{{ $var['key'] }}" 
                                   class="w-full border-2 border-indigo-300 rounded-xl px-6 py-5 text-lg" 
                                   placeholder="{{ $var['placeholder'] ?? '' }}" required>
                        @elseif($var['type'] === 'textarea')
                            <textarea wire:model="answers.{{ $var['key'] }}" rows="5"
                                      class="w-full border-2 border-indigo-300 rounded-xl px-6 py-5 text-lg" required></textarea>
                        @elseif($var['type'] === 'select')
                            <select wire:model="answers.{{ $var['key'] }}" 
                                    class="w-full border-2 border-indigo-300 rounded-xl px-6 py-5 text-lg" required>
                                <option value="">Choose...</option>
                                @foreach($var['options'] as $opt)
                                    <option>{{ $opt }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-16">
                <button type="submit" 
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-16 py-8 rounded-2xl text-3xl font-bold shadow-2xl transition transform hover:scale-105">
                    Generate {{ $template->name }}
                </button>
            </div>
        </form>
    </div>

    @if($generatedDocument)
        <div class="bg-green-50 dark:bg-green-900/20 border-4 border-green-500 rounded-2xl p-12 text-center">
            <svg class="w-32 h-32 text-green-600 mx-auto mb-8" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <h2 class="text-4xl font-bold text-green-800 dark:text-green-300 mb-6">
                {{ $template->name }} Generated Successfully!
            </h2>
            <div class="space-x-6">
                <a href="{{ Storage::url($generatedDocument->generated_file) }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-12 py-6 rounded-xl text-2xl font-bold inline-block">
                    Download PDF
                </a>
                <button wire:click="signDocument" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-12 py-6 rounded-xl text-2xl font-bold">
                    Sign & Lock
                </button>
            </div>
        </div>
    @endif
</div>