<div class="space-y-6">
    <div>
        <h2 class="text-lg font-semibold text-white mb-4">
            {{ __('Mis Planes de Entrenamiento') }}
        </h2>

        @if ($plans->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($plans as $plan)
                    <div class="bg-gray-900 border border-gray-700 rounded-xl p-5 shadow-sm space-y-3">
                        <div class="flex justify-between items-start">
                            <h3 class="text-base font-bold text-white">
                                {{ $plan->getPlanNameAttribute() }}
                            </h3>
                            <span>
                                {{ $plan->getStatusAttribute() }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-400 italic">
                            {{ $plan->getPlanDescriptionAttribute() }}
                        </p>

                        <p class="text-sm text-gray-300">
                            <span class="text-gray-500">{{ __('Entrenador:') }}</span>
                            {{ $plan->getTrainerNameAttribute() }}
                        </p>

                        <p class="text-sm text-gray-300">
                            <span class="text-gray-500">{{ __('Asignado:') }}</span>
                            {{ $plan->getAssignedAtFormattedAttribute() }}
                        </p>

                        <div class="pt-2">
                            <a href="{{ route('plans.show', $plan->id) }}"
                                class="inline-block text-sm text-blue-400 hover:underline">
                                {{ __('Ver detalle') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400">{{ __('No tienes planes de entrenamiento asignados.') }}</p>
        @endif
    </div>
</div>
