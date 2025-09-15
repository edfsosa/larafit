<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información personal')
                    ->columnSpanFull()
                    ->columns(3)
                    ->components([
                        Select::make('user_id')
                            ->label('Nombre completo')
                            ->relationship('user', 'name')
                            ->disabled()
                            ->required(),
                        DatePicker::make('joined_at')
                            ->label('Fecha de ingreso')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->closeOnDateSelection()
                            ->default(now())
                            ->required(),
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
                        TextInput::make('emergency_contact_name')
                            ->label('Nombre del contacto de emergencia')
                            ->default(null),
                        TextInput::make('emergency_contact_phone')
                            ->label('Teléfono del contacto de emergencia')
                            ->tel()
                            ->default(null),
                    ]),
                Section::make('Perfil fitness')
                    ->relationship('fitnessProfile')
                    ->columnSpanFull()
                    ->columns(4)
                    ->schema([
                        TextInput::make('height')
                            ->label('Altura (cm)')
                            ->integer()
                            ->minValue(1)
                            ->maxValue(300)
                            ->step(1)
                            ->required(),
                        TextInput::make('weight')
                            ->label('Peso (kg)')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(500)
                            ->step(0.1)
                            ->required(),
                        Select::make('workout_location')
                            ->label('Lugar de entrenamiento')
                            ->options([
                                'gym' => 'Gimnasio',
                                'home' => 'Casa',
                                'outdoors' => 'Aire libre',
                            ])
                            ->native(false)
                            ->required(),
                        Select::make('experience_level')
                            ->label('Nivel de experiencia')
                            ->options([
                                'beginner' => 'Principiante',
                                'intermediate' => 'Intermedio',
                                'advanced' => 'Avanzado',
                            ])
                            ->native(false)
                            ->required(),
                        Select::make('intensity_preference')
                            ->label('Intensidad deseada')
                            ->options([
                                'low' => 'Baja',
                                'medium' => 'Media',
                                'high' => 'Alta',
                            ])
                            ->native(false)
                            ->required(),
                        Select::make('workout_duration')
                            ->label('Duración preferida')
                            ->options([
                                '15-30 minutes' => '15-30 minutos',
                                '30-45 minutes' => '30-45 minutos',
                                '45-60 minutes' => '45-60 minutos',
                                '60+ minutes' => 'Más de 60 minutos',
                            ])
                            ->native(false)
                            ->required(),
                        Select::make('preferred_workout_time')
                            ->label('Hora del día preferida')
                            ->options([
                                'morning' => 'Mañana',
                                'afternoon' => 'Tarde',
                                'evening' => 'Noche',
                            ])
                            ->native(false)
                            ->required(),
                        TextInput::make('weekly_workout_frequency')
                            ->label('Sesiones semanales')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(14)
                            ->default(3)
                            ->required(),
                        CheckboxList::make('body_focus_areas')
                            ->label('Áreas del cuerpo a enfocar')
                            ->options([
                                'arms' => 'Brazos',
                                'legs' => 'Piernas',
                                'back' => 'Espalda',
                                'chest' => 'Pecho',
                                'shoulders' => 'Hombros',
                                'abs' => 'Abdomen',
                                'glutes' => 'Glúteos',
                                'full body' => 'Cuerpo completo',
                            ])
                            ->columns(4)
                            ->columnSpanFull()
                            ->required(),
                        CheckboxList::make('available_equipment')
                            ->label('Equipamiento disponible')
                            ->options([
                                'gym' => 'Gimnasio completo',
                                'dumbbells' => 'Mancuernas',
                                'barbell' => 'Barra',
                                'kettlebells' => 'Kettlebells',
                                'resistance bands' => 'Bandas',
                                'bodyweight' => 'Peso corporal',
                                'machines' => 'Máquinas',
                                'none' => 'Ninguno',
                            ])
                            ->columns(4)
                            ->columnSpanFull()
                            ->required(),
                    ])
            ]);
    }
}
