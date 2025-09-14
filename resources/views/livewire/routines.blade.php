<div>
    <div class="max-w-5xl mx-auto py-10 px-4">
        <flux:heading size="xl" level="1">{{ __('Mis Rutinas Asignadas') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">
            {{ __('Aquí puedes ver tus rutinas y marcar los ejercicios completados.') }}
        </flux:subheading>

        <flux:separator variant="subtle" class="mb-6" />

        @forelse ($routines as $routine)
            <div
                class="mb-6 border border-gray-200 dark:border-zinc-700 rounded-lg p-4 shadow-sm bg-white dark:bg-zinc-800">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                    {{ $routine->name }}
                    <span class="text-sm text-gray-500">
                        ({{ ucfirst($routine->difficulty) }}, {{ $routine->duration_minutes }} min)
                    </span>
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-300">{{ $routine->description }}</p>

                @if (in_array($routine->id, $expandedRoutines) && $routine->exercises->isNotEmpty())
                    <div class="mt-4">
                        <h3 class="text-md font-medium text-gray-700 dark:text-gray-300 mb-2">Ejercicios:</h3>
                        <ul class="space-y-2">
                            @foreach ($routine->exercises as $exercise)
                                @php
                                    $isCompleted = \App\Models\ExerciseCompletion::where(
                                        'member_routine_id',
                                        $routine->member_routine_id,
                                    )
                                        ->where('exercise_id', $exercise->id)
                                        ->where('completed', true)
                                        ->exists();
                                @endphp

                                <li class="p-3 bg-gray-50 dark:bg-zinc-700 rounded-md">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <strong>{{ $exercise->name }}</strong>
                                            — {{ $exercise->pivot->sets ?? '?' }}x{{ $exercise->pivot->reps ?? '?' }}
                                            @if ($exercise->pivot->duration_seconds)
                                                — {{ $exercise->pivot->duration_seconds }}s
                                            @endif
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $exercise->description }}
                                            </div>
                                        </div>

                                        <div>
                                            @if ($isCompleted)
                                                <flux:badge size="sm" variant="success">✔ Completado</flux:badge>
                                            @else
                                                <flux:button size="xs"
                                                    wire:click="markCompleted({{ $routine->member_routine_id }}, {{ $exercise->id }})">
                                                    Marcar como completado
                                                </flux:button>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mt-4">
                    <flux:button size="sm" wire:click="toggleExercises({{ $routine->id }})">
                        {{ in_array($routine->id, $expandedRoutines) ? 'Ocultar ejercicios' : 'Ver ejercicios' }}
                    </flux:button>
                </div>
            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-300">No tienes rutinas asignadas actualmente.</p>
        @endforelse
    </div>
</div>
