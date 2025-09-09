<?php

namespace App\Filament\Resources\Exercises\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExercisesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Imagen')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('muscle_group')
                    ->label('Grupo muscular')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'chest' => 'Pecho',
                        'back' => 'Espalda',
                        'legs' => 'Piernas',
                        'arms' => 'Brazos',
                        'shoulders' => 'Hombros',
                        'core' => 'Core',
                        'full_body' => 'Cuerpo completo',
                        'other' => 'Otro',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cardio' => 'Cardio',
                        'strength' => 'Fuerza',
                        'flexibility' => 'Flexibilidad',
                        'balance' => 'Equilibrio',
                        'mobility' => 'Movilidad',
                        'other' => 'Otro',
                        default => $state,
                    })
                    ->searchable()
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
                Action::make('view-video')
                    ->label('Ver video')
                    ->url(fn ($record) => $record->video_url)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-play')
                    ->visible(fn ($record) => !empty($record->video_url)),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
