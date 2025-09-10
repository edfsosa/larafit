<?php

namespace App\Filament\Resources\MemberRoutines\Schemas;

use App\Models\Member;
use App\Models\Trainer;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MemberRoutineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('member_id')
                    ->label('Miembro')
                    ->options(function () {
                        return Member::with('user')->get()->pluck('user.name', 'id');
                    })
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('routine_id')
                    ->label('Rutina')
                    ->relationship('routine', 'name')
                    ->native(false)
                    ->preload()
                    ->searchable()
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
                DatePicker::make('assigned_at')
                    ->label('Fecha de asignación')
                    ->default(now())
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->closeOnDateSelection()
                    ->required(),
                Textarea::make('notes')
                    ->label('Notas')
                    ->rows(3)
                    ->maxLength(1000)
                    ->default(null)
                    ->columnSpanFull(),
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
            ]);
    }
}
