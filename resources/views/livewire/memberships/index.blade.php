<div class="space-y-6">
    {{-- Membresía actual --}}
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h2 class="text-lg font-bold mb-4">{{ __('Current Membership') }}</h2>

        @if ($currentMembership)
            <div class="space-y-2">
                <p class="text-xl font-semibold">{{ $currentMembership->membership->name }}</p>
                <p class="text-sm text-gray-500 italic">{{ $currentMembership->membership->description }}</p>

                {{-- Detalles --}}
                <div class="text-sm text-gray-600 dark:text-gray-300">
                    <p><strong>{{ __('Price') }}:</strong>
                        ₲{{ number_format($currentMembership->membership->price, 0, ',', '.') }}</p>
                    <p><strong>{{ __('Duration') }}:</strong> {{ $currentMembership->membership->duration_days }}
                        {{ __('days') }}</p>
                    <p><strong>{{ __('From') }}:</strong>
                        {{ \Carbon\Carbon::parse($currentMembership->start_date)->format('d/m/Y') }}</p>
                    <p><strong>{{ __('Until') }}:</strong>
                        {{ \Carbon\Carbon::parse($currentMembership->end_date)->format('d/m/Y') }}</p>
                </div>

                <span class="inline-block mt-2 px-3 py-1 rounded bg-green-100 text-green-700 text-sm">
                    {{ ucfirst($currentMembership->status) }}
                </span>

                {{-- Pagos --}}
                @if ($currentMembership->payments->count())
                    <div class="mt-4">
                        <h3 class="text-md font-bold mb-2">{{ __('Payments') }}</h3>
                        <ul class="text-sm divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($currentMembership->payments as $payment)
                                <li class="py-2 flex justify-between items-center">
                                    <div>
                                        <p>{{ $payment->method }} -
                                            ₲{{ number_format($payment->amount, 0, ',', '.') }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}
                                            @if ($payment->notes)
                                                — <span class="italic">{{ $payment->notes }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <a href="{{ route('payments.receipt', $payment->id) }}" target="_blank"
                                        class="text-blue-600 text-xs underline hover:text-blue-800">
                                        {{ __('PDF') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif
        @if (!$currentMembership)
            <p class="text-gray-500">{{ __('No active membership found.') }}</p>
        @endif
    </div>

    {{-- Histórico de membresías --}}
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h2 class="text-lg font-bold mb-4">{{ __('Membership History') }}</h2>

        @if ($membershipHistory->count())
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($membershipHistory as $memberMembership)
                    <li class="py-4">
                        <div class="space-y-1">
                            <p class="text-base font-semibold">{{ $memberMembership->membership->name }}</p>
                            <p class="text-sm text-gray-500 italic">{{ $memberMembership->membership->description }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ __('From') }}:
                                {{ \Carbon\Carbon::parse($memberMembership->start_date)->format('d/m/Y') }} <br>
                                {{ __('Until') }}:
                                {{ \Carbon\Carbon::parse($memberMembership->end_date)->format('d/m/Y') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ __('Price') }}:
                                ₲{{ number_format($memberMembership->membership->price, 0, ',', '.') }} —
                                {{ __('Duration') }}: {{ $memberMembership->membership->duration_days }} días
                            </p>
                            <span
                                class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm">
                                {{ ucfirst($memberMembership->status) }}
                            </span>

                            {{-- Pagos --}}
                            @if ($memberMembership->payments->count())
                                <div class="mt-2">
                                    <h4 class="text-sm font-bold">{{ __('Payments') }}</h4>
                                    <ul class="text-sm">
                                        @foreach ($memberMembership->payments as $payment)
                                            <li class="flex justify-between text-sm py-1">
                                                <span>{{ $payment->method }}
                                                    (₲{{ number_format($payment->amount, 0, ',', '.') }})
                                                </span>
                                                <span
                                                    class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</span>
                                                <a href="{{ route('payments.receipt', $payment->id) }}" target="_blank"
                                                    class="text-blue-600 text-xs underline hover:text-blue-800">
                                                    {{ __('PDF') }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">{{ __('No previous memberships found.') }}</p>
        @endif
    </div>
</div>
