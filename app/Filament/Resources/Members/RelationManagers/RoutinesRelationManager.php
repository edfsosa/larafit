<?php

namespace App\Filament\Resources\Members\RelationManagers;

use App\Models\Trainer;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RoutinesRelationManager extends RelationManager
{
    protected static string $relationship = 'routines';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('assigned_at')
                    ->label('Fecha de Asignación')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->required(),
                TextInput::make('estimated_time')
                    ->label('Tiempo Estimado (min)')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'not_started' => 'No Iniciada',
                        'in_progress' => 'En Progreso',
                        'completed' => 'Completada',
                    ])
                    ->native(false)
                    ->default('not_started')
                    ->required(),
                Select::make('assigned_by')
                    ->label('Asignado Por')
                    ->options(function () {
                        return \App\Models\Trainer::all()->pluck('user.name', 'id');
                    })
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Rutina')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pivot.assigned_at')
                    ->label('Asignado')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('pivot.estimated_time')
                    ->label('Tiempo Estimado (min)')
                    ->sortable(),
                TextColumn::make('pivot.status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'not_started' => 'secondary',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn($state) => match ($state) {
                        'not_started' => 'No Iniciada',
                        'in_progress' => 'En Progreso',
                        'completed' => 'Completada',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pivot.assigned_by')
                    ->label('Entrenador asignado')
                    ->formatStateUsing(fn($state) => Trainer::find($state)?->user->name ?? 'N/A')
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
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->label('Asignar Rutina'),
            ])
            ->recordActions([
                EditAction::make(),
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
