<?php

namespace App\Filament\Resources\Routines\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RoutineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->placeholder('Nombre de la rutina, ej. "Rutina de fuerza para principiantes"')
                    ->maxLength(255)
                    ->required(),
                Select::make('difficulty')
                    ->label('Dificultad')
                    ->options([
                        'beginner' => 'Principiante',
                        'intermediate' => 'Intermedio',
                        'advanced' => 'Avanzado',
                    ])
                    ->native(false)
                    ->required(),
                TextInput::make('duration_minutes')
                    ->label('Duración (minutos)')
                    ->placeholder('Duración estimada de la rutina en minutos, ej. 60')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(300)
                    ->step(1)
                    ->nullable(),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true)
                    ->inline(false)
                    ->hiddenOn('create')
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->placeholder('Descripción de la rutina, ej. "Esta rutina está diseñada para..."')
                    ->rows(3)
                    ->maxLength(1000)
                    ->columnSpanFull()
                    ->nullable(),
            ])
            ->columns(4);
    }
}
