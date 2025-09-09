<div class="p-6 grid grid-cols-1 gap-6">
    @foreach ($routines as $routine)
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            {{-- Header --}}
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-bold text-gray-800">{{ $routine->name }}</h3>
                <span
                    class="px-3 py-1 text-sm font-medium rounded-full
                {{ match ($routine->difficulty) {
                    'beginner' => 'bg-green-400 text-green-800',
                    'intermediate' => 'bg-yellow-400 text-yellow-800',
                    'advanced' => 'bg-red-400 text-red-800',
                    default => 'bg-gray-400 text-gray-800',
                } }}">
                    {{ ucfirst($routine->difficulty) }}
                </span>
            </div>

            {{-- Trainer and Duration info --}}
            <div class="flex items-center gap-3 mb-6">
                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                @if (isset($routine->trainer))
                    <span class="text-gray-700 font-medium">{{ $routine->trainer->user->name ?? 'Sistema' }}</span>
                @endif

                @if (isset($routine->member))
                    <span class="text-gray-700 font-medium">{{ $routine->member->user->name ?? 'Sistema' }}</span>
                @endif

                <div class="flex items-center gap-1 text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12,6 12,12 16,14" />
                    </svg>
                    <span class="text-sm">{{ $routine->duration_minutes }} min</span>
                </div>
            </div>

            {{-- Progress section --}}
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700 font-medium">Progreso</span>
                    <span class="text-blue-600 font-bold text-lg">80%</span>
                </div>

                {{-- Progress bar --}}
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-500 ease-out
                    {{ $routine->progress >= 80
                        ? 'bg-gradient-to-r from-green-500 to-emerald-500'
                        : ($routine->progress >= 60
                            ? 'bg-gradient-to-r from-blue-500 to-purple-500'
                            : ($routine->progress >= 40
                                ? 'bg-gradient-to-r from-yellow-500 to-orange-500'
                                : 'bg-gradient-to-r from-red-500 to-pink-500')) }}"
                        style="width: 80%">
                    </div>
                </div>
            </div>

            {{-- Assigned at --}}
            <div class="flex justify-between items-center mb-4 text-sm text-gray-600">
                <div>
                    <span class="font-medium">Fecha de asignación:</span> {{ $routine->assigned_at }}
                </div>
            </div>

            {{-- Toggle exercises button --}}
            <button wire:click="toggleExercises"
                class="w-full flex items-center justify-center gap-2 py-2 text-gray-600 hover:text-gray-800 transition-colors border-t border-gray-100 pt-4">
                <span>Ver ejercicios</span>
                <svg class="w-4 h-4 transform transition-transform {{ $showExercises ? 'rotate-180' : '' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <polyline points="6,9 12,15 18,9" />
                </svg>
            </button>

            {{-- Exercises list (collapsible) --}}
            @if ($showExercises)
                <div class="mt-4 space-y-2 border-t border-gray-100 pt-4" wire:transition>
                    @foreach ($routine->exercises as $exercise)
                        <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg">
                            <span class="text-sm font-medium">{{ $exercise->name }}</span>
                            <span
                                class="text-sm text-gray-500">{{ $exercise->pivot->reps }}x{{ $exercise->pivot->sets }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    @endforeach
</div>
