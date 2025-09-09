<x-layouts.app>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Routines') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage your routines') }}
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <livewire:routines />
</x-layouts.app>
