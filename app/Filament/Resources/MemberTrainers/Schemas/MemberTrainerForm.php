<?php

namespace App\Filament\Resources\MemberTrainers\Schemas;

use App\Models\Member;
use App\Models\Trainer;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class MemberTrainerForm
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
                Select::make('trainer_id')
                    ->label('Entrenador')
                    ->options(function () {
                        return Trainer::with('user')->get()->pluck('user.name', 'id');
                    })
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->required(),
                DateTimePicker::make('assigned_at')
                    ->label('Asignado el')
                    ->default(now())
                    ->native(false)
                    ->displayFormat('d/m/Y H:i')
                    ->closeOnDateSelection()
                    ->required(),
            ]);
    }
}
