<?php

namespace App\Filament\Resources\Routines\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExercisesRelationManager extends RelationManager
{
    protected static string $relationship = 'exercises';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('sets')
                    ->label('Series')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                TextInput::make('reps')
                    ->label('Repeticiones')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                TextInput::make('rest_seconds')
                    ->label('Descanso (s)')
                    ->numeric()
                    ->minValue(0)
                    ->required(),
                TextInput::make('duration_seconds')
                    ->label('Duración (s)')
                    ->numeric()
                    ->minValue(0)
                    ->nullable(),
                TextInput::make('order')
                    ->label('Orden')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                Textarea::make('instructions')
                    ->label('Instrucciones')
                    ->rows(3)
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn($state) => match ($state) {
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
                TextColumn::make('pivot.sets')
                    ->label('Series')
                    ->sortable(),
                TextColumn::make('pivot.reps')
                    ->label('Repeticiones')
                    ->sortable(),
                TextColumn::make('pivot.rest_seconds')
                    ->label('Descanso (s)')
                    ->sortable(),
                TextColumn::make('pivot.duration_seconds')
                    ->label('Duración (s)')
                    ->sortable(),
                TextColumn::make('pivot.order')
                    ->label('Orden')
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
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->label('Adjuntar Ejercicio'),
            ])
            ->recordActions([
                EditAction::make(),
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
