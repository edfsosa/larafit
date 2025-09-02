<?php

namespace App\Filament\Resources\Equipment\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MaintenancesRelationManager extends RelationManager
{
    protected static string $relationship = 'maintenances';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->label('Fecha')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->required(),
                Select::make('type')
                    ->label('Tipo')
                    ->options([
                        'routine' => 'Rutina',
                        'repair' => 'Reparación',
                        'inspection' => 'Inspección',
                        'other' => 'Otro',
                    ])
                    ->native(false)
                    ->required(),
                TextInput::make('cost')
                    ->label('Costo')
                    ->integer()
                    ->step(1)
                    ->minValue(0)
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->columnSpanFull(),
            ])
            ->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('date')
            ->columns([
                TextColumn::make('date')
                    ->label('Fecha')
                    ->searchable()
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'routine' => 'Rutina',
                        'repair' => 'Reparación',
                        'inspection' => 'Inspección',
                        'other' => 'Otro',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('cost')
                    ->label('Costo')
                    ->money('PYG', true)
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
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
