<?php

namespace App\Filament\Resources\Exercises\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ExerciseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->placeholder('Nombre del ejercicio, ej. Sentadilla')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('video_url')
                    ->label('URL del video')
                    ->placeholder('URL del video del ejercicio, ej. https://www.youtube.com/watch?v=example')
                    ->url()
                    ->default(null),
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
                    ->default('full_body')
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
                    ->default('strength')
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->placeholder('Descripción del ejercicio, ej. La sentadilla es un ejercicio de fuerza que trabaja principalmente los músculos de las piernas y glúteos.')
                    ->rows(3)
                    ->maxLength(1000)
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Imagen')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('exercises/images')
                    ->default(null)
                    ->columnSpanFull()
                    ->maxSize(1024),
            ]);
    }
}
