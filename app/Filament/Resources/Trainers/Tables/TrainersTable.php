<?php

namespace App\Filament\Resources\Trainers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TrainersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('user.avatar')
                    ->label('Avatar')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('user.name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.document_number')
                    ->label('Documento')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.birth_date')
                    ->label('Edad')
                    ->getStateUsing(fn($record) => $record->user->birth_date ? $record->user->birth_date->age : 'N/A')
                    ->sortable(),
                TextColumn::make('user.gender')
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
                TextColumn::make('user.email')
                    ->label('Correo electrónico')
                    ->searchable()
                    ->sortable()
                    ->url(fn($record) => "mailto:{$record->user->email}"),
                TextColumn::make('user.phone')
                    ->label('Teléfono')
                    ->searchable()
                    ->sortable()
                    ->url(fn($record) => $record->user->phone ? "tel:{$record->user->phone}" : null)
                    ->openUrlInNewTab(),
                TextColumn::make('specialty')
                    ->label('Especialidad')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'strength_training' => 'Entrenamiento de fuerza',
                        'cardio' => 'Cardio',
                        'yoga' => 'Yoga',
                        'pilates' => 'Pilates',
                        'nutrition' => 'Nutrición',
                        'crossfit' => 'CrossFit',
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
                SelectFilter::make('specialty')
                    ->label('Especialidad')
                    ->options([
                        'strength_training' => 'Entrenamiento de fuerza',
                        'cardio' => 'Cardio',
                        'yoga' => 'Yoga',
                        'pilates' => 'Pilates',
                        'nutrition' => 'Nutrición',
                        'crossfit' => 'CrossFit',
                        'other' => 'Otro',
                    ])
                    ->multiple(),
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
