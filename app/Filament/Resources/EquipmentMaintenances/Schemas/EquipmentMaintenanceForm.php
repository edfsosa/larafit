<?php

namespace App\Filament\Resources\EquipmentMaintenances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EquipmentMaintenanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('equipment_id')
                    ->label('Equipo')
                    ->relationship('equipment', 'name')
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->required(),
                DatePicker::make('date')
                    ->label('Fecha de mantenimiento')
                    ->default(now())
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->closeOnDateSelection()
                    ->required(),
                Select::make('type')
                    ->label('Tipo')
                    ->options([
                        'preventive' => 'Preventivo',
                        'repair' => 'Reparación',
                        'inspection' => 'Inspección',
                        'other' => 'Otro',
                    ])
                    ->native(false)
                    ->required(),
                TextInput::make('cost')
                    ->label('Costo')
                    ->integer()
                    ->minValue(0)
                    ->maxValue(999999999)
                    ->default(0)
                    ->prefix('₲')
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->maxLength(1000)
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
