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
                Select::make('member_id')
                    ->label('Miembro')
                    ->relationship('member', 'id')
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->user->name)
                    ->native(false)
                    ->preload()
                    ->required()
                    ->searchable(),
                Select::make('membership_id')
                    ->label('Membresía')
                    ->relationship('membership', 'name')
                    ->native(false)
                    ->preload()
                    ->required()
                    ->searchable(),
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
