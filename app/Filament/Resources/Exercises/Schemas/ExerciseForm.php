<?php

namespace App\Filament\Resources\Exercises\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ExerciseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('video_url')
                    ->label('URL del video')
                    ->url()
                    ->default(null),
                Grid::make(3)
                    ->schema([
                        Select::make('muscle_group')
                            ->label('Grupo muscular')
                            ->options([
                                'legs' => 'Piernas',
                                'arms' => 'Brazos',
                                'back' => 'Espalda',
                                'chest' => 'Pecho',
                                'shoulders' => 'Hombros',
                                'core' => 'Core',
                                'full_body' => 'Cuerpo completo',
                                'other' => 'Otro',
                            ])
                            ->native(false)
                            ->required(),
                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'cardio' => 'Cardio',
                                'strength' => 'Fuerza',
                                'flexibility' => 'Flexibilidad',
                                'balance' => 'Equilibrio',
                                'mobility' => 'Movilidad',
                                'other' => 'Otro',
                            ])
                            ->native(false)
                            ->required(),
                        Select::make('equipment_id')
                            ->label('Equipo')
                            ->relationship('equipment', 'name')
                            ->preload()
                            ->searchable()
                            ->native(false)
                            ->nullable(),
                    ])
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Imagen')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('exercises/images')
                            ->maxSize(1024)
                            ->nullable(),
                        Textarea::make('description')
                            ->label('Descripción')
                            ->rows(3)
                            ->maxLength(1000)
                            ->nullable(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
