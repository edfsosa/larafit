<?php

namespace App\Filament\Resources\Routines\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class RoutineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                /* Wizard::make([
                    Step::make('Rutina')
                        ->schema([
                            TextInput::make('name')
                                ->label('Nombre')
                                ->required()
                                ->maxLength(255),
                            Textarea::make('description')
                                ->label('Descripción')
                                ->rows(3)
                                ->maxLength(65535),
                            Select::make('difficulty')
                                ->label('Dificultad')
                                ->options([
                                    'beginner' => 'Principiante',
                                    'intermediate' => 'Intermedio',
                                    'advanced' => 'Avanzado',
                                ])
                                ->required(),
                            TextInput::make('duration_minutes')
                                ->label('Duración (minutos)')
                                ->numeric()
                                ->minValue(1)
                                ->required(),
                        ]),
                    Step::make('Fases')
                        ->schema([
                            Repeater::make('phases')
                                ->label('Fases')
                                ->relationship()
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Nombre')
                                        ->maxLength(255)
                                        ->required(),
                                    TextInput::make('order')
                                        ->label('Orden')
                                        ->integer()
                                        ->minValue(1)
                                        ->required(),
                                    Textarea::make('description')
                                        ->label('Descripción')
                                        ->rows(1)
                                        ->maxLength(1000)
                                        ->columnSpanFull()
                                        ->nullable(),
                                ])
                                ->orderColumn('order')
                                ->columns(2)
                        ]),
                    Step::make('Semanas')
                        ->schema([
                            // Aquí puedes agregar los campos relacionados con las semanas de la rutina
                            
                        ]),
                    Step::make('Días')
                        ->schema([
                            // Aquí puedes agregar los campos relacionados con los días de la rutina
                        ]),
                    Step::make('Ejercicios')
                        ->schema([
                            // Aquí puedes agregar los campos relacionados con los ejercicios de la rutina
                        ]),
                ])->columnSpanFull(), */
            ]);
    }
}
