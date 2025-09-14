<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar')
                    ->label('Avatar')
                    ->image()
                    ->avatar()
                    ->imageEditor()
                    ->circleCropper()
                    ->downloadable()
                    ->maxSize(5120) // 5MB
                    ->disk('public')
                    ->directory('avatars')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->label('Nombre completo')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->minLength(8)
                    ->maxLength(255)
                    ->revealable()
                    ->required()
                    ->dehydrated(fn($state) => filled($state))
                    ->hiddenOn('edit'),
                TextInput::make('document_number')
                    ->label('Número de documento')
                    ->integer()
                    ->minValue(1)
                    ->maxLength(20)
                    ->required(),
                Select::make('gender')
                    ->label('Género')
                    ->options(['male' => 'Masculino', 'female' => 'Femenino'])
                    ->native(false)
                    ->required(),
                DatePicker::make('birth_date')
                    ->label('Fecha de nacimiento')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->closeOnDateSelection()
                    ->required(),
                TextInput::make('phone')
                    ->label('Número de teléfono')
                    ->tel()
                    ->maxLength(20)
                    ->prefix('+595')
                    ->default(null),
                TextInput::make('address')
                    ->label('Dirección')
                    ->maxLength(255)
                    ->default(null),
                Select::make('city')
                    ->label('Ciudad')
                    ->options([
                        'Asunción' => 'Asunción',
                        'Ciudad del Este' => 'Ciudad del Este',
                        'Encarnación' => 'Encarnación',
                        'San Lorenzo' => 'San Lorenzo',
                        'Luque' => 'Luque',
                        'Capiatá' => 'Capiatá',
                        'Lambaré' => 'Lambaré',
                        'Fernando de la Mora' => 'Fernando de la Mora',
                        'Ñemby' => 'Ñemby',
                        'Itauguá' => 'Itauguá',
                        'Villa Elisa' => 'Villa Elisa',
                        'Areguá' => 'Areguá',
                        'Ypacaraí' => 'Ypacaraí',
                        'San Antonio' => 'San Antonio',
                        'Caacupé' => 'Caacupé',
                        'Paraguarí' => 'Paraguarí',
                        'Coronel Oviedo' => 'Coronel Oviedo',
                        'Villarrica' => 'Villarrica',
                        'Concepción' => 'Concepción',
                        'Pedro Juan Caballero' => 'Pedro Juan Caballero',
                        'Salto del Guairá' => 'Salto del Guairá',
                    ])
                    ->searchable()
                    ->native(false)
                    ->required(),
                Select::make('role')
                    ->label('Rol')
                    ->relationship('roles', 'name')
                    ->preload()
                    ->native(false)
                    ->required(),
            ])
            ->columns(3);
    }
}
