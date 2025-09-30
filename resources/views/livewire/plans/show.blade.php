<div class="space-y-6">
    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-white mb-4">
            {{ $plan->getPlanNameAttribute() }}
        </h2>

        <p class="text-sm text-gray-400 italic mb-2">
            {{ $plan->getPlanDescriptionAttribute() }}
        </p>

        <p class="text-sm text-gray-300">
            <span class="text-gray-500">Entrenador:</span> {{ $plan->getTrainerNameAttribute() }}
        </p>

        <p class="text-sm text-gray-300">
            <span class="text-gray-500">Estado:</span> {{ ucfirst($plan->status) }}
        </p>

        <p class="text-sm text-gray-300">
            <span class="text-gray-500">Asignado:</span> {{ $plan->getAssignedAtFormattedAttribute() }}
        </p>
    </div>

    {{-- Estructura del plan: fases, semanas, días --}}
    @if ($plan->phases)
        <div class="space-y-6">
            @foreach ($plan->phases as $phase)
                <div class="bg-gray-900 border border-gray-700 rounded-xl p-5 shadow-sm">
                    <h3 class="text-md font-semibold text-white mb-4">
                        {{ $phase->name }} ({{ __('Fase') }})
                    </h3>

                    @if ($phase->weeks->count())
                        <div class="space-y-4">
                            @foreach ($phase->weeks as $week)
                                <div class="bg-gray-800 border border-gray-600 rounded-lg p-4">
                                    <h4 class="text-sm font-semibold text-white mb-3">
                                        {{ $week->name }} ({{ __('Semana') }})
                                    </h4>

                                    @if ($week->days->count())
                                        <div class="space-y-3">
                                            @foreach ($week->days as $day)
                                                <div class="bg-gray-700 border border-gray-500 rounded-md p-3">
                                                    <h5 class="text-sm font-medium text-white mb-2">
                                                        {{ $day->name }} ({{ __('Día') }})
                                                    </h5>

                                                    @if ($day->exercises->count())
                                                        <ul class="list-disc list-inside space-y-1">
                                                            @foreach ($day->exercises as $exercise)
                                                                <li class="text-sm text-gray-300">
                                                                    {{ $exercise->name }} -
                                                                    <span class="text-gray-400 italic">
                                                                        {{ $exercise->sets }} sets x
                                                                        {{ $exercise->reps }} reps
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p class="text-sm text-gray-400 italic">
                                                            {{ __('No hay ejercicios asignados para este día.') }}
                                                        </p>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-400 italic">
                                            {{ __('No hay días asignados para esta semana.') }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-400 italic">
                            {{ __('No hay semanas asignadas para esta fase.') }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p class="text-sm text-gray-400 italic">
            {{ __('No hay fases asignadas para este plan.') }}
        </p>
    @endif
</div>
