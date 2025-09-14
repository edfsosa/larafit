<?php

namespace App\Filament\Resources\Exercises\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                SelectFilter::make('muscle_group')
                    ->label('Grupo muscular')
                    ->options([
                        'legs' => 'Piernas',
                        'arms' => 'Brazos',
                        'back' => 'Espalda',
                        'chest' => 'Pecho',
                        'shoulders' => 'Hombros',
                        'core' => 'Core',
                        'full_body' => 'Cuerpo completo',
                        'other' => 'Otro',
                    ])
                    ->multiple()
                    ->native(false),
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'cardio' => 'Cardio',
                        'strength' => 'Fuerza',
                        'flexibility' => 'Flexibilidad',
                        'balance' => 'Equilibrio',
                        'mobility' => 'Movilidad',
                        'other' => 'Otro',
                    ])
                    ->multiple()
                    ->native(false),
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
