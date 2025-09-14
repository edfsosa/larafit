<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Nombre completo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('document_number')
                    ->label('Documento')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('birth_date')
                    ->label('Edad')
                    ->getStateUsing(fn($record) => $record->birth_date ? $record->birth_date->age : 'N/A')
                    ->sortable(),
                TextColumn::make('gender')
                    ->label('Género')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'male' => 'info',
                        'female' => 'danger',
                        default => 'primary',
                    })
                    ->formatStateUsing(fn($state) => match ($state) {
                        'male' => 'Masculino',
                        'female' => 'Femenino',
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Correo electrónico')
                    ->searchable()
                    ->sortable()
                    ->url(fn($record) => "mailto:{$record->email}"),
                TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable()
                    ->sortable()
                    ->url(fn($record) => $record->phone ? "tel:{$record->phone}" : null)
                    ->openUrlInNewTab(),
                // Rol
                TextColumn::make('roles.name')
                    ->label('Rol')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
