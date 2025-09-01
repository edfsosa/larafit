<x-layouts.app :title="__('My Routines')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if ($routines->isEmpty())
            <p class="text-gray-600">{{ __('You have no routines yet.') }}</p>
        @else
            <ul class="space-y-4">
                @foreach ($routines as $routine)
                    <li class="p-4 border rounded shadow">
                        <h2 class="text-lg font-semibold">{{ $routine->name }}</h2>
                        <p class="text-gray-600">{{ $routine->description }}</p>
                        <p class="text-sm text-gray-500">{{ __('Created at:') }}
                            {{ $routine->created_at->format('d/m/Y') }}
                        </p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-layouts.app>
