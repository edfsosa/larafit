<?php

namespace App\Filament\Resources\Routines\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class RoutinesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('difficulty')
                    ->label('Dificultad')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'beginner' => 'success',
                        'intermediate' => 'warning',
                        'advanced' => 'danger',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn($state) => match ($state) {
                        'beginner' => 'Principiante',
                        'intermediate' => 'Intermedio',
                        'advanced' => 'Avanzado',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('duration_minutes')
                    ->label('Duración (min)')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Activo')
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
