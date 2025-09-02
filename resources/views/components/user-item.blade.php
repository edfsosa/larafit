<li class="p-4 border rounded shadow flex justify-between items-center">
    <div>
        <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
        <p class="text-gray-600">{{ $user->email }}</p>
        <p class="text-sm text-gray-500">{{ __('Created at:') }}
            {{ $user->created_at->format('d/m/Y') }}
        </p>
    </div>
    <div class="flex space-x-2">
        <a href="{{ route('users.show', $user) }}" class="text-green-500 hover:underline">
            {{ __('View') }}
        <a href="{{ route('users.edit', $user) }}" class="text-blue-500 hover:underline">
            {{ __('Edit') }}
        </a>
        <form action="{{ route('users.destroy', $user) }}" method="POST"
            onsubmit="return confirm('{{ __('Are you sure?') }}')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline">
                {{ __('Delete') }}
            </button>
        </form>
    </div>
</li>
