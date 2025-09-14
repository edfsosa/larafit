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
    protected static ?string $title = 'Rutinas';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('assigned_at')
                    ->label('Fecha de asignación')
                    ->default(now())
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->closeOnDateSelection()
                    ->required(),
                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'not_started' => 'No iniciada',
                        'in_progress' => 'En progreso',
                        'completed' => 'Completada',
                    ])
                    ->native(false)
                    ->default('not_started')
                    ->hiddenOn('create')
                    ->required(),
                Select::make('trainer_id')
                    ->label('Entrenador')
                    ->options(function () {
                        return Trainer::with('user')->get()->pluck('user.name', 'id');
                    })
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->required(),
            ])
            ->columns(3);
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
                TextColumn::make('pivot.trainer_id')
                    ->label('Entrenador')
                    ->formatStateUsing(fn($state) => Trainer::find($state)?->user->name ?? 'N/A')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pivot.assigned_at')
                    ->label('Asignada el')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('pivot.status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'not_started' => 'danger',
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->label('Asignar')
                    ->modalHeading('Asignar Rutina al Miembro'),
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
