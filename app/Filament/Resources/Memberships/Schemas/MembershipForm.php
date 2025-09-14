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
                    ->integer()
                    ->minValue(0)
                    ->maxValue(999999999)
                    ->default(0)
                    ->prefix('₲')
                    ->required(),
                TextInput::make('duration_days')
                    ->label('Duración (días)')
                    ->integer()
                    ->minValue(1)
                    ->maxLength(3)
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->default(null)
                    ->columnSpanFull(),
            ])
            ->columns(3);
    }
}
