<?php

namespace App\Filament\Resources\Trainers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TrainerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Usuario')
                    ->relationship('user', 'name')
                    ->disabled()
                    ->required(),
                Select::make('specialty')
                    ->label('Especialidad')
                    ->options([
                        'strength_training' => 'Entrenamiento de fuerza',
                        'cardio' => 'Cardio',
                        'yoga' => 'Yoga',
                        'pilates' => 'Pilates',
                        'nutrition' => 'Nutrición',
                        'crossfit' => 'CrossFit',
                    ])
                    ->native(false)
                    ->required(),
                Textarea::make('bio')
                    ->label('Biografía')
                    ->rows(3)
                    ->maxLength(1000)
                    ->columnSpanFull()
                    ->nullable(),
            ]);
    }
}
