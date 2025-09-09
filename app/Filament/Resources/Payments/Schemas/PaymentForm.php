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
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('amount')
                    ->label('Monto')
                    ->integer()
                    ->required()
                    ->minValue(0),
                DatePicker::make('date')
                    ->label('Fecha')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->required()
                    ->default(now()),
                Select::make('method')
                    ->label('Método de Pago')
                    ->options([
                        'credit_card' => 'Tarjeta de Crédito',
                        'debit_card' => 'Tarjeta de Débito',
                        'paypal' => 'PayPal',
                        'bank_transfer' => 'Transferencia Bancaria',
                        'cash' => 'Efectivo',
                    ])
                    ->native(false)
                    ->required(),
                Textarea::make('notes')
                    ->label('Notas')
                    ->rows(3)
                    ->columnSpanFull()
                    ->nullable(),
            ]);
    }
}
