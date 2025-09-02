<x-layouts.app :title="__('Routine Details')">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Routine Details') }}</h1>

        <div class="p-4 border rounded shadow bg-white">
            <!-- Nombre -->
            <div class="mb-4">
                <h2 class="text-lg font-semibold">{{ __('Name') }}</h2>
                <p class="text-gray-600">{{ $routine->name }}</p>
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <h2 class="text-lg font-semibold">{{ __('Description') }}</h2>
                <p class="text-gray-600">{{ $routine->description ?? __('No description provided.') }}</p>
            </div>

            <!-- Entrenador -->
            <div class="mb-4">
                <h2 class="text-lg font-semibold">{{ __('Trainer') }}</h2>
                <p class="text-gray-600">
                    {{ $routine->trainer->user->name ?? __('No trainer assigned.') }}
                </p>
            </div>

            <!-- Fecha de Creación -->
            <div class="mb-4">
                <h2 class="text-lg font-semibold">{{ __('Created At') }}</h2>
                <p class="text-gray-600">{{ $routine->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <!-- Última Actualización -->
            <div class="mb-4">
                <h2 class="text-lg font-semibold">{{ __('Last Updated') }}</h2>
                <p class="text-gray-600">{{ $routine->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Botón para regresar -->
        <div class="mt-4">
            <a href="{{ route('routines.index') }}"
                class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                {{ __('Back to Routines') }}
            </a>
        </div>
    </div>
</x-layouts.app>
