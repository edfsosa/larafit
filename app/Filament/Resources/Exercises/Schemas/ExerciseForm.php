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
                    ->required(),
                TextInput::make('video_url')
                    ->label('URL del video')
                    ->url()
                    ->default(null),
                Select::make('difficulty')
                    ->label('Dificultad')
                    ->options([
                        'beginner' => 'Principiante',
                        'intermediate' => 'Intermedio',
                        'advanced' => 'Avanzado',
                    ])
                    ->native(false)
                    ->default('beginner')
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
