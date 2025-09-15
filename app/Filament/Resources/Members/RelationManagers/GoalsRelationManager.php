<?php

namespace App\Filament\Resources\Members\RelationManagers;

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

class GoalsRelationManager extends RelationManager
{
    protected static string $relationship = 'goals';
    protected static ?string $title = 'Objetivos';

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
                        'completed' => 'Completado',
                        'pending' => 'Pendiente',
                    ])
                    ->native(false)
                    ->default('pending')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->label('Objetivo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('assigned_at')
                    ->label('Fecha de asignación')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'completed' => 'success',
                        'pending' => 'warning',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'completed' => 'Completado',
                        'pending' => 'Pendiente',
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
                    ->modalHeading('Asignar Objetivo al Miembro'),
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
