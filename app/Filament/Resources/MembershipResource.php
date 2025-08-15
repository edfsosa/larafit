<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MembershipResource\Pages;
use App\Filament\Resources\MembershipResource\RelationManagers;
use App\Models\Membership;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MembershipResource extends Resource
{
    protected static ?string $model = Membership::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $label = 'Membresía';
    protected static ?string $pluralLabel = 'Membresías';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('member_id')
                    ->label('Miembro')
                    ->relationship('member', 'name')
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('membership_type_id')
                    ->label('Tipo de Membresía')
                    ->relationship('membershipType', 'name')
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->required(),
                DatePicker::make('start_date')
                    ->label('Fecha de Inicio')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->required()
                    ->default(now()),
                DatePicker::make('end_date')
                    ->label('Fecha de Fin')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->after('start_date')
                    ->nullable()
                    ->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable()
                    ->copyable(),
                TextColumn::make('member.name')
                    ->label('Miembro')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('membershipType.name')
                    ->label('Tipo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Desde')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Hasta')
                    ->date('d/m/Y')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Activo')
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
                SelectFilter::make('member_id')
                    ->label('Miembro')
                    ->relationship('member', 'name')
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->placeholder('Buscar miembro'),
                SelectFilter::make('membership_type_id')
                    ->label('Tipo de Membresía')
                    ->relationship('membershipType', 'name')
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->placeholder('Buscar tipo de membresía'),
                TernaryFilter::make('is_active')
                    ->label('Activo')
                    ->nullable()
                    ->placeholder('Todos')
                    ->trueLabel('Sí')
                    ->falseLabel('No')
                    ->native(false),
                Filter::make('start_date')
                    ->form([
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('from')
                                    ->label('Desde')
                                    ->displayFormat('d/m/Y')
                                    ->native(false)
                                    ->closeOnDateSelection(),
                                DatePicker::make('to')
                                    ->label('Hasta')
                                    ->displayFormat('d/m/Y')
                                    ->native(false)
                                    ->closeOnDateSelection()
                                    ->after('from'),
                            ])
                    ])
                     ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn (Builder $query, $date): Builder => $query->whereDate('start_date', '>=', $date))
                            ->when($data['to'], fn (Builder $query, $date): Builder => $query->whereDate('end_date', '<=', $date));
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMemberships::route('/'),
            'create' => Pages\CreateMembership::route('/create'),
            'edit' => Pages\EditMembership::route('/{record}/edit'),
        ];
    }
}
