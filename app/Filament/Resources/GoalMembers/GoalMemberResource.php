<?php

namespace App\Filament\Resources\GoalMembers;

use App\Filament\Resources\GoalMembers\Pages\ManageGoalMembers;
use App\Models\GoalMember;
use App\Models\Member;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class GoalMemberResource extends Resource
{
    protected static ?string $model = GoalMember::class;
    protected static ?string $navigationLabel = 'Objetivos';
    protected static ?string $modelLabel = 'Objetivo';
    protected static ?string $pluralModelLabel = 'Objetivos';
    protected static ?int $navigationSort = 7;
    protected static string | UnitEnum | null $navigationGroup = 'Miembros';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTrophy;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('goal_id')
                    ->label('Objetivo')
                    ->relationship('goal', 'title')
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('member_id')
                    ->label('Miembro')
                    ->options(function () {
                        return Member::with('user')->get()->pluck('user.name', 'id');
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('goal.title')
                    ->label('Objetivo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('member.user.name')
                    ->label('Miembro')
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
                SelectFilter::make('goal_id')
                    ->label('Objetivo')
                    ->relationship('goal', 'title')
                    ->multiple()
                    ->native(false)
                    ->preload()
                    ->searchable(),
                SelectFilter::make('member_id')
                    ->label('Miembro')
                    ->options(function () {
                        return Member::with('user')->get()->pluck('user.name', 'id');
                    })
                    ->multiple()
                    ->native(false)
                    ->preload()
                    ->searchable(),
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

    public static function getPages(): array
    {
        return [
            'index' => ManageGoalMembers::route('/'),
        ];
    }
}
