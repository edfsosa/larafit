<?php

namespace App\Filament\Resources\TrainingPlans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TrainingPlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
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
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->maxLength(1000)
                    ->columnSpanFull()
                    ->nullable(),
                Toggle::make('is_template')
                    ->label('¿Es una plantilla?')
                    ->inline(false)
                    ->default(true)
                    ->required(),
            ]);
    }
}
