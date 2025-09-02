<?php

namespace App\Filament\Resources\Equipment\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EquipmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->label('Imagen')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('equipment-images')
                    ->maxSize(1024) // 1MB
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                Select::make('type')
                    ->label('Tipo')
                    ->options([
                        'cardio' => 'Cardio',
                        'strength' => 'Fortaleza',
                        'flexibility' => 'Flexibilidad',
                        'balance' => 'Balance',
                        'mobility' => 'Movilidad',
                        'other' => 'Otro',
                    ])
                    ->native(false)
                    ->required(),
                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'available' => 'Disponible',
                        'maintenance' => 'Mantenimiento',
                        'out_of_order' => 'Fuera de servicio',
                    ])
                    ->native(false)
                    ->default('available')
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('video_url')
                    ->label('URL del video')
                    ->url()
                    ->default(null),
                TextInput::make('serial_number')
                    ->label('Número de serie')
                    ->default(null),
                TextInput::make('brand')
                    ->label('Marca')
                    ->default(null),
                TextInput::make('model')
                    ->label('Modelo')
                    ->default(null),
                DatePicker::make('purchased_at')
                    ->label('Fecha de compra')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->default(null),
                TextInput::make('purchase_price')
                    ->label('Precio de compra')
                    ->integer()
                    ->minValue(0)
                    ->maxLength(10)
                    ->default(null),
            ])
            ->columns(3);
    }
}
