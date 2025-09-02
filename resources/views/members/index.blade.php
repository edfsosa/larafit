<x-layouts.app :title="__('Members')">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Members') }}</h1>

        <!-- Botón para agregar un nuevo miembro -->
        {{--         <div class="mb-4">
            <a href="{{ route('members.create') }}"
                class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                {{ __('Add New Member') }}
            </a>
        </div> --}}

        <!-- Verificar si hay miembros -->
        @if ($members->isEmpty())
            <p class="text-gray-600">{{ __('No members found.') }}</p>
        @else
            <!-- Tabla de miembros -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded shadow">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Name') }}</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Email') }}</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Phone') }}</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Created At') }}</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr class="border-t">
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->user->name }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->user->email }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->user->phone }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700">
                                    <div class="flex space-x-2">
                                        <!-- Botón Editar -->
                                        {{-- <a href="{{ route('members.edit', $member) }}"
                                            class="text-blue-500 hover:underline">{{ __('Edit') }}</a> --}}
                                        <!-- Botón Eliminar -->
                                        {{-- <form action="{{ route('members.destroy', $member) }}" method="POST"
                                            onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">
                                                {{ __('Delete') }}
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $members->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
