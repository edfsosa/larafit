<?php

namespace App\Filament\Resources\Reviews\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('routine.name')
                    ->label('Rutina')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reviewer.name')
                    ->label('Revisor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reviewed.name')
                    ->label('Revisado')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('rating')
                    ->label('Calificación')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('comment')
                    ->label('Comentario')
                    ->limit(50)
                    ->wrap(),
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
