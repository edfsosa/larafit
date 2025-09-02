<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Usuario')
                    ->relationship('user', 'name')
                    ->preload()
                    ->searchable()
                    ->native(false)
                    ->required(),
                DatePicker::make('joined_at')
                    ->label('Fecha de ingreso')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->default(now())
                    ->required(),
                TextInput::make('emergency_contact_name')
                    ->label('Nombre del contacto de emergencia')
                    ->default(null),
                TextInput::make('emergency_contact_phone')
                    ->label('Teléfono del contacto de emergencia')
                    ->tel()
                    ->default(null),
                TextInput::make('height')
                    ->label('Altura (cm)')
                    ->integer()
                    ->minValue(1)
                    ->maxValue(300)
                    ->step(1)
                    ->default(null),
                TextInput::make('weight')
                    ->label('Peso (kg)')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(500)
                    ->step(0.1)
                    ->default(null),
                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'active' => 'Activo',
                        'inactive' => 'Inactivo',
                        'suspended' => 'Suspendido',
                    ])
                    ->native(false)
                    ->default('active')
                    ->hiddenOn('create')
                    ->required(),
            ]);
    }
}
