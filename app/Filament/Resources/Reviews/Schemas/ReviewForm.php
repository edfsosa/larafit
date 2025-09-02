<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('routine_id')
                    ->label('Rutina')
                    ->relationship('routine', 'name')
                    ->preload()
                    ->searchable()
                    ->native(false)
                    ->required(),
                Select::make('reviewer_id')
                    ->label('Revisor')
                    ->relationship('reviewer', 'name')
                    ->preload()
                    ->searchable()
                    ->native(false)
                    ->required(),
                Select::make('reviewed_id')
                    ->label('Revisado')
                    ->relationship('reviewed', 'name')
                    ->preload()
                    ->searchable()
                    ->native(false)
                    ->required(),
                TextInput::make('rating')
                    ->label('Calificación')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->step(0.1)
                    ->required(),
                Textarea::make('comment')
                    ->label('Comentario')
                    ->rows(3)
                    ->maxLength(1000)
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }
}
