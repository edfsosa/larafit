<x-layouts.app :title="__('Edit Routine')">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Edit Routine') }}</h1>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario -->
        <form action="{{ route('routines.update', $routine) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <input type="text" name="name" id="name" value="{{ old('name', $routine->name) }}"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $routine->description) }}</textarea>
            </div>

            <!-- Entrenador -->
            <div>
                <label for="trainer_id" class="block text-sm font-medium text-gray-700">{{ __('Trainer') }}</label>
                <select name="trainer_id" id="trainer_id"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">{{ __('Select a trainer') }}</option>
                    @foreach ($trainers as $trainer)
                        <option value="{{ $trainer->id }}"
                            {{ old('trainer_id', $routine->trainer_id) == $trainer->id ? 'selected' : '' }}>
                            {{ $trainer->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botón de Enviar -->
            <div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    {{ __('Update Routine') }}
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
