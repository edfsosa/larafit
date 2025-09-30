<div class="space-y-6">
    {{-- Mensajes de éxito --}}
    @if (session()->has('success'))
        <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alerta de membresía por vencer --}}
    @if ($daysLeft !== null && $daysLeft <= 5 && $daysLeft > 0)
        <div class="mb-4 p-4 rounded bg-yellow-50 border border-yellow-300 text-yellow-800">
            {{ __('Your current membership will expire in :days days. Please consider renewing it.', ['days' => $daysLeft]) }}
        </div>
    @endif


    {{-- Membresía actual --}}
    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-bold text-white mb-4">{{ __('Current Membership') }}</h2>

        @if ($currentMembership)
            <div class="space-y-2">
                {{-- Nombre --}}
                <p class="text-2xl font-bold text-white">
                    {{ $currentMembership->getMembershipNameAttribute() }}
                </p>

                {{-- Descripción --}}
                <p class="text-sm text-gray-400 italic">
                    {{ $currentMembership->membership->description }}
                </p>

                {{-- Detalles --}}
                <div class="text-sm text-gray-300 space-y-1 mt-3">
                    <p><span class="text-gray-400">{{ __('Price') }}:</span>
                        {{ $currentMembership->membership->getFormattedPriceAttribute() }}
                    </p>
                    <p><span class="text-gray-400">{{ __('Duration') }}:</span>
                        {{ $currentMembership->membership->getDurationInMonthsAttribute() }} {{ __('months') }}
                    </p>
                    <p><span class="text-gray-400">{{ __('From') }}:</span>
                        {{ $currentMembership->getFormattedStartDateAttribute() }}
                    </p>
                    <p><span class="text-gray-400">{{ __('Until') }}:</span>
                        {{ $currentMembership->getFormattedEndDateAttribute() }}
                    </p>
                </div>

                {{-- Estado (badge simplificado por ahora) --}}
                <span
                    class="inline-block mt-3 px-3 py-1 text-xs font-medium rounded-full bg-blue-500/10 text-blue-400 ring-1 ring-inset ring-blue-500/20">
                    {{ ucfirst($currentMembership->getStatusAttribute()) }}
                </span>
            </div>

            {{-- Pagos --}}
            @if ($currentMembership->payments->count())
                <div class="mt-6">
                    <details
                        class="bg-gray-800/60 border border-gray-700 rounded-md p-4 group open:shadow-inner transition-all duration-200">
                        <summary
                            class="cursor-pointer list-none flex items-center justify-between text-white font-medium text-sm hover:underline">
                            <span>{{ __('Payments') }}</span>
                        </summary>

                        <ul class="text-sm divide-y divide-gray-700 mt-4">
                            @foreach ($currentMembership->payments as $payment)
                                <li class="py-3 flex justify-between items-start">
                                    <div class="space-y-1">
                                        <p class="text-gray-100 font-medium">
                                            {{ $payment->getMethodAttribute() }}
                                            <span class="text-green-400 font-semibold">
                                                — {{ $payment->getFormattedAmountAttribute() }}
                                            </span>
                                        </p>
                                        <p class="text-xs text-gray-400">
                                            {{ $payment->getFormattedDateAttribute() }}
                                            @if ($payment->notes)
                                                — <span class="italic">{{ $payment->notes }}</span>
                                            @endif
                                        </p>
                                    </div>

                                    <a href="{{ route('payments.receipt', $payment->id) }}" target="_blank"
                                        class="text-blue-400 text-xs underline hover:text-blue-300 mt-1">
                                        {{ __('PDF') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </details>
                </div>
            @endif


            {{-- Sin membresía activa --}}
        @else
            <p class="text-gray-400 italic">{{ __('No active membership.') }}</p>
            @if ($this->canAcquireMembership)
                <flux:modal.trigger name="acquire-membership">
                    <flux:button variant="primary">
                        {{ __('Acquire New Membership') }}
                    </flux:button>
                </flux:modal.trigger>
            @endif
        @endif
    </div>

    {{-- Histórico de membresías --}}
    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-bold text-white mb-4">{{ __('Membership History') }}</h2>

        @if ($membershipHistory->count())
            <ul class="divide-y divide-gray-800">
                @foreach ($membershipHistory as $memberMembership)
                    @php
                        $status = $memberMembership->getStatusAttribute();
                        $statusStyles = match ($status) {
                            'active' => 'bg-green-500/10 text-green-400 ring-1 ring-inset ring-green-500/20',
                            'expired' => 'bg-yellow-500/10 text-yellow-400 ring-1 ring-inset ring-yellow-500/20',
                            'cancelled' => 'bg-red-500/10 text-red-400 ring-1 ring-inset ring-red-500/20',
                            default => 'bg-gray-500/10 text-gray-300 ring-1 ring-inset ring-gray-500/20',
                        };
                    @endphp

                    <li>
                        <details
                            class="bg-gray-800/60 border border-gray-700 rounded-md p-4 group open:shadow-inner transition-all duration-200">
                            <summary
                                class="cursor-pointer list-none flex items-center justify-between text-white font-medium text-sm hover:underline">
                                <span>{{ $memberMembership->getMembershipNameAttribute() }}</span>
                                <span
                                    class="ml-2 text-xs font-semibold inline-flex items-center {{ $statusStyles }} px-2 py-0.5 rounded-full">
                                    {{ ucfirst($status) }}
                                </span>
                            </summary>

                            <div class="mt-3 space-y-1 text-sm text-gray-300">
                                <p class="italic text-gray-400">
                                    {{ $memberMembership->membership->description }}
                                </p>
                                <p><span class="text-gray-400">{{ __('From') }}:</span>
                                    {{ $memberMembership->getFormattedStartDateAttribute() }}</p>
                                <p><span class="text-gray-400">{{ __('Until') }}:</span>
                                    {{ $memberMembership->getFormattedEndDateAttribute() }}</p>
                                <p>
                                    <span class="text-gray-400">{{ __('Price') }}:</span>
                                    {{ $memberMembership->membership->getFormattedPriceAttribute() }}
                                    &nbsp;—&nbsp;
                                    <span class="text-gray-400">{{ __('Duration') }}:</span>
                                    {{ $memberMembership->membership->getDurationInMonthsAttribute() }}
                                    {{ __('months') }}
                                </p>
                            </div>
                        </details>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-400 italic">{{ __('No previous memberships found.') }}</p>
        @endif
    </div>


    {{-- Modal para adquirir membresía --}}
    <flux:modal name="acquire-membership" class="md:w-96">
        <form wire:submit.prevent="acquireMembership" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Acquire New Membership') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Please fill out the form below to acquire a new membership.') }}
                </flux:text>
            </div>

            <div>
                <flux:label for="membership_id">{{ __('Membership') }}</flux:label>
                <flux:select id="membership_id" wire:model="membership_id" required>
                    <option value="">{{ __('-- Select --') }}</option>
                    @foreach ($availableMemberships as $membership)
                        <option value="{{ $membership->id }}">
                            {{ $membership->name }} -
                            {{ $membership->getFormattedPriceAttribute() }} /
                            {{ $membership->getDurationInMonthsAttribute() }} {{ __('months') }}
                        </option>
                    @endforeach
                </flux:select>
                <flux:error for="membership_id" class="mt-1" />
            </div>

            <div>
                <flux:label for="payment_method">{{ __('Payment Method') }}</flux:label>
                <flux:select id="payment_method" wire:model="payment_method" required>
                    <option value="">{{ __('-- Select --') }}</option>
                    <option value="credit_card">{{ __('Credit Card') }}</option>
                    <option value="debit_card">{{ __('Debit Card') }}</option>
                    <option value="paypal">{{ __('PayPal') }}</option>
                    <option value="bank_transfer">{{ __('Bank Transfer') }}</option>
                    <option value="cash">{{ __('Cash') }}</option>
                    <option value="qr_code">{{ __('QR Code') }}</option>
                </flux:select>
                <flux:error for="payment_method" class="mt-1" />
            </div>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">
                    {{ __('Save') }}
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
