<?php

namespace App\Filament\Resources\Memberships\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MembershipForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('price')
                    ->label('Precio')
                    ->required()
                    ->integer()
                    ->minValue(1)
                    ->maxLength(10)
                    ->step(1),
                TextInput::make('duration_days')
                    ->label('Duración (días)')
                    ->required()
                    ->integer()
                    ->minValue(1)
                    ->maxLength(3)
                    ->helperText('Por ejemplo, 30 para mensual, 365 para anual')
                    ->step(1),
                Textarea::make('description')
                    ->label('Descripción')
                    ->default(null)
                    ->columnSpanFull(),
            ])
            ->columns(3);
    }
}
