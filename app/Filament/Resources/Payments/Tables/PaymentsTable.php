<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('memberMembership.member.user.name')
                    ->label('Miembro')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('memberMembership.membership.name')
                    ->label('Membresía')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Monto')
                    ->money('PYG', true)
                    ->sortable(),
                TextColumn::make('method')
                    ->label('Método de Pago')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'credit_card' => 'Tarjeta de Crédito',
                        'debit_card' => 'Tarjeta de Débito',
                        'paypal' => 'PayPal',
                        'bank_transfer' => 'Transferencia Bancaria',
                        'cash' => 'Efectivo',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
