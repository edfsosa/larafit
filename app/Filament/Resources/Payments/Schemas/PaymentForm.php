<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('member_membership_id')
                    ->label('Membresía')
                    ->options(function () {
                        return \App\Models\MemberMembership::with('member.user', 'membership')
                            ->where('status', 'active')
                            ->get()
                            ->mapWithKeys(function ($membership) {
                                $memberName = $membership->member?->user?->name ?? 'Desconocido';
                                $membershipName = $membership->membership?->name ?? 'Desconocida';
                                return [$membership->id => "{$memberName} - {$membershipName}"];
                            });
                    })
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $memberMembership = \App\Models\MemberMembership::with('membership')->find($state);

                        if ($memberMembership && $memberMembership->membership) {
                            $set('amount', $memberMembership->membership->price);
                        } else {
                            $set('amount', null);
                        }
                    })
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('amount')
                    ->label('Monto')
                    ->numeric()
                    ->prefix('₲')
                    ->required()
                    ->minValue(0)
                    ->maxValue(100000000),
                DatePicker::make('date')
                    ->label('Fecha')
                    ->default(now())
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->closeOnDateSelection()
                    ->required(),
                Select::make('method')
                    ->label('Método de Pago')
                    ->options([
                        'qr_code' => 'QR',
                        'credit_card' => 'Tarjeta de Crédito',
                        'debit_card' => 'Tarjeta de Débito',
                        'bank_transfer' => 'Transferencia Bancaria',
                        'cash' => 'Efectivo',
                        'paypal' => 'PayPal',
                    ])
                    ->native(false)
                    ->required(),
                Textarea::make('notes')
                    ->label('Notas')
                    ->rows(3)
                    ->maxLength(1000)
                    ->columnSpanFull()
                    ->nullable(),
            ]);
    }
}
