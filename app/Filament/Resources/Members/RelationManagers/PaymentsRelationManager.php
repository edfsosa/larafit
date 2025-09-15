<?php

namespace App\Filament\Resources\Members\RelationManagers;

use App\Models\MemberMembership;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';
    protected static ?string $title = 'Pagos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Select que muestra solo las membresías (MemberMembership) del miembro actual
                Select::make('membership_id')
                    ->label('Membresía')
                    ->options(function () {
                        $memberId = $this->ownerRecord->id;
                        return MemberMembership::where('member_id', $memberId)
                            ->with('membership')
                            ->get()
                            ->pluck('membership.name', 'membership.id');
                    })
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('amount')
            ->columns([
                TextColumn::make('date')
                    ->label('Fecha')
                    ->date('d/m/Y')
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
            ->headerActions([
                CreateAction::make()
                    ->label('Crear Pago'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
