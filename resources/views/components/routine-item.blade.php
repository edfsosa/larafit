<li class="p-4 border rounded shadow bg-white">
    <!-- Tarjeta principal -->
    <div class="flex justify-between items-start">
        <div>
            <h2 class="text-lg font-semibold">{{ $routine->name }}</h2>
            <p class="text-gray-600">{{ $routine->description }}</p>
            <p class="text-sm text-gray-500">
                {{ __('Created at:') }} {{ $routine->created_at->format('d/m/Y') }}
            </p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('routines.show', $routine) }}"
                class="px-2 py-1 text-green-600 hover:text-green-800 text-sm font-medium">
                {{ __('View') }}
            </a>
            <a href="{{ route('routines.edit', $routine) }}"
                class="px-2 py-1 text-blue-600 hover:text-blue-800 text-sm font-medium">
                {{ __('Edit') }}
            </a>
            <form action="{{ route('routines.destroy', $routine) }}" method="POST"
                onsubmit="return confirm('{{ __('Are you sure?') }}')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-2 py-1 text-red-600 hover:text-red-800 text-sm font-medium">
                    {{ __('Delete') }}
                </button>
            </form>
        </div>
    </div>

    <!-- Acordeón para ejercicios -->
    <div x-data="{ open: false }" class="mt-4">
        <button @click="open = !open" :aria-expanded="open.toString()"
            aria-controls="exercise-list-{{ $routine->id }}"
            class="w-full text-left px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 
                   focus:outline-none focus:ring-2 focus:ring-blue-500">
            <span x-show="!open">{{ __('Show Exercises') }}</span>
            <span x-show="open">{{ __('Hide Exercises') }}</span>
        </button>

        <div x-show="open" x-transition id="exercise-list-{{ $routine->id }}" class="mt-2 border-t pt-2">
            @if ($routine->exercises->isEmpty())
                <p class="text-gray-600">{{ __('No exercises found for this routine.') }}</p>
            @else
                <ul class="space-y-2">
                    @foreach ($routine->exercises as $exercise)
                        <li class="p-2 border rounded bg-gray-50">
                            <h3 class="text-sm font-semibold">{{ $exercise->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $exercise->description }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</li>
