<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('guard_name')
                    ->label('Guardia')
                    ->required()
                    ->default('web')
                    ->disabled(),
                CheckboxList::make('permissions')
                    ->label('Permisos')
                    ->relationship('permissions', 'name')
                    ->helperText('Selecciona los permisos que deseas asignar a este rol.')
                    ->columnSpanFull()
                    ->columns(4)
                    ->bulkToggleable()
                    ->required(),
            ]);
    }
}
