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
                Select::make('trainer_id')
                    ->label('Entrenador')
                    ->relationship('trainer', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name)
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->required(),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true)
                    ->inline(false)
                    ->hiddenOn('create')
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->columnSpanFull()
                    ->nullable(),
            ])
            ->columns(4);
    }
}
