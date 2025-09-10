<?php

namespace App\Filament\Resources\MemberMemberships\Schemas;

use App\Models\Member;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MemberMembershipForm
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
                Select::make('membership_id')
                    ->label('Membresía')
                    ->relationship('membership', 'name')
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->required(),
                DatePicker::make('start_date')
                    ->label('Fecha de inicio')
                    ->default(now())
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->closeOnDateSelection()
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Fecha de fin')
                    ->default(now()->addMonth())
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->closeOnDateSelection()
                    ->required(),
                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'active' => 'Activa',
                        'expired' => 'Expirada',
                        'cancelled' => 'Cancelada',
                    ])
                    ->native(false)
                    ->default('active')
                    ->hiddenOn('create')
                    ->required(),
            ]);
    }
}
