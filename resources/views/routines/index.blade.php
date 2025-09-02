<x-layouts.app :title="__('My Routines')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if ($routines->isEmpty())
            <div class="text-center text-gray-600">
                <p>{{ __('No routines found.') }}</p>
                <a href="{{ route('routines.create') }}" class="text-blue-500 hover:underline">
                    {{ __('Add a new routine') }}
                </a>
            </div>
        @else
            <a href="{{ route('routines.create') }}" class="text-blue-500 hover:underline">
                {{ __('Add a new routine') }}
            </a>
            <ul class="space-y-4">
                @foreach ($routines as $routine)
                    <x-routine-item :routine="$routine" />
                @endforeach
            </ul>
            <!-- Paginación -->
            <div class="mt-4">
                {{ $routines->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
