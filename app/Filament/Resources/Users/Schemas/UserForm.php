<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre completo')
                    ->required(),
                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->revealable()
                    ->minLength(8)
                    ->required(),
                Select::make('gender')
                    ->label('Género')
                    ->options(['male' => 'Masculino', 'female' => 'Femenino'])
                    ->native(false)
                    ->required(),
                TextInput::make('document_number')
                    ->label('Número de documento')
                    ->integer()
                    ->minValue(1)
                    ->required(),
                TextInput::make('phone')
                    ->label('Número de teléfono')
                    ->tel()
                    ->default(null),
                TextInput::make('address')
                    ->label('Dirección')
                    ->default(null),
                TextInput::make('city')
                    ->label('Ciudad')
                    ->default(null),
                DatePicker::make('birth_date')
                    ->label('Fecha de nacimiento')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->default(null),
                FileUpload::make('avatar')
                    ->label('Avatar')
                    ->image()
                    ->avatar()
                    ->imageEditor()
                    ->circleCropper()
                    ->downloadable()
                    ->maxSize(1024)
                    ->disk('public')
                    ->directory('avatars')
                    ->default(null),
            ]);
    }
}
