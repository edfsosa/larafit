<x-layouts.app :title="__('Users')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if ($users->isEmpty())
            <div class="text-center text-gray-600">
                <p>{{ __('No users found.') }}</p>
                <a href="{{ route('users.create') }}" class="text-blue-500 hover:underline">
                    {{ __('Add a new user') }}
                </a>
            </div>
        @else
            <a href="{{ route('users.create') }}" class="text-blue-500 hover:underline">
                {{ __('Add a new user') }}
            </a>
            <ul class="space-y-4">
                @foreach ($users as $user)
                    <x-user-item :user="$user" />
                @endforeach
            </ul>
            <!-- Paginación -->
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
