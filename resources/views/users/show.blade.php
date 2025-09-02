<x-layouts.app :title="__('User Details')">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('User Details') }}</h1>

        <div class="p-4 border rounded shadow bg-white">
            <!-- Nombre -->
            <div class="mb-4">
                <h2 class="text-lg font-semibold">{{ __('Name') }}</h2>
                <p class="text-gray-600">{{ $user->name }}</p>
            </div>

            <!-- Correo Electrónico -->
            <div class="mb-4">
                <h2 class="text-lg font-semibold">{{ __('Email') }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>

            <!-- Fecha de Creación -->
            <div class="mb-4">
                <h2 class="text-lg font-semibold">{{ __('Created At') }}</h2>
                <p class="text-gray-600">{{ $user->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <!-- Última Actualización -->
            <div class="mb-4">
                <h2 class="text-lg font-semibold">{{ __('Last Updated') }}</h2>
                <p class="text-gray-600">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Botón para regresar -->
        <div class="mt-4">
            <a href="{{ route('users.index') }}"
                class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                {{ __('Back to Users') }}
            </a>
        </div>
    </div>
</x-layouts.app>
