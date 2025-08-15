<?php

namespace App\Filament\Resources\WorkoutPlanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('exercise_id')
                    ->relationship('exercise', 'name')
                    ->required(),
                Forms\Components\TextInput::make('sets')
                    ->numeric()
                    ->default(3)
                    ->minValue(1)
                    ->required(),
                Forms\Components\TextInput::make('reps')
                    ->numeric()
                    ->default(10)
                    ->minValue(1)
                    ->required(),
                Forms\Components\TextInput::make('weight')
                    ->label('Weight (kg)')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),
                Forms\Components\Textarea::make('notes')
                    ->rows(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('exercise.name')
            ->columns([
                Tables\Columns\TextColumn::make('exercise.name')
                    ->label('Exercise')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sets')
                    ->sortable(),
                Tables\Columns\TextColumn::make('reps')
                    ->sortable(),
                Tables\Columns\TextColumn::make('weight')
                    ->label('Weight (kg)')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
