<?php

namespace App\Filament\Resources\MemberRoutines\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MemberRoutinesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('member.user.name')
                    ->label('Miembro')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('routine.name')
                    ->label('Rutina')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('trainer.user.name')
                    ->label('Entrenador')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('assigned_at')
                    ->label('Asignada el')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'not_started' => 'gray',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn($state) => match ($state) {
                        'not_started' => 'No iniciada',
                        'in_progress' => 'En progreso',
                        'completed' => 'Completada',
                        default => $state,
                    })
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
