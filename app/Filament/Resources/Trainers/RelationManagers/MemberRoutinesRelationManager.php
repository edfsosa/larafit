<?php

namespace App\Filament\Resources\Trainers\RelationManagers;

use App\Models\Member;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MemberRoutinesRelationManager extends RelationManager
{
    protected static string $relationship = 'memberRoutines';
    protected static ?string $title = 'Rutinas Asignadas';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('member_id')
                    ->label('Miembro')
                    ->options(function () {
                        return Member::where('status', 'active')
                            ->with('user')
                            ->get()
                            ->pluck('user.name', 'id');
                    })
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('routine_id')
                    ->label('Rutina')
                    ->relationship('routine', 'name')
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->required(),
                DatePicker::make('assigned_at')
                    ->label('Fecha de Asignación')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->closeOnDateSelection()
                    ->default(now())
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
                Textarea::make('notes')
                    ->label('Notas')
                    ->rows(3)
                    ->maxLength(1000)
                    ->columnSpanFull()
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('member.user.name')
                    ->label('Member')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('routine.name')
                    ->label('Rutina')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('assigned_at')
                    ->label('Asignado')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('status')
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
                SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'not_started' => 'No Iniciada',
                        'in_progress' => 'En Progreso',
                        'completed' => 'Completada',
                    ])
                    ->multiple(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Asignar Rutina'),
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
