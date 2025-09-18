<?php

namespace App\Filament\Resources\AttendanceRecords;

use App\Filament\Resources\AttendanceRecords\Pages\ManageAttendanceRecords;
use App\Models\AttendanceRecord;
use App\Models\Member;
use App\Models\Trainer;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class AttendanceRecordResource extends Resource
{
    protected static ?string $model = AttendanceRecord::class;
    protected static ?string $navigationLabel = 'Asistencias';
    protected static ?string $modelLabel = 'Asistencia';
    protected static ?string $pluralModelLabel = 'Asistencias';
    protected static ?int $navigationSort = 8;
    protected static string | UnitEnum | null $navigationGroup = 'Miembros';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                MorphToSelect::make('attendable')
                    ->label('Usuario')
                    ->types([
                        Type::make(Member::class)
                            ->label('Miembro')
                            ->getOptionLabelFromRecordUsing(fn(Member $record): string => $record->user->name),
                        Type::make(Trainer::class)
                            ->label('Entrenador')
                            ->getOptionLabelFromRecordUsing(fn(Trainer $record): string => $record->user->name),
                    ])
                    ->native(false)
                    ->required(),
                DateTimePicker::make('checked_in_at')
                    ->label('Ingreso')
                    ->native(false)
                    ->displayFormat('d/m/Y H:i')
                    ->closeOnDateSelection()
                    ->required(),
                DateTimePicker::make('checked_out_at')
                    ->label('Salida')
                    ->native(false)
                    ->displayFormat('d/m/Y H:i')
                    ->closeOnDateSelection()
                    ->nullable(),
                Select::make('method')
                    ->label('Método')
                    ->options([
                        'manual' => 'Manual',
                        'qr_code' => 'Código QR',
                        'biometric' => 'Biométrico',
                        'face_recognition' => 'Reconocimiento facial',
                    ])
                    ->native(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('attendable.user.name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('attendable_type')
                    ->label('Tipo')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        Member::class => 'Miembro',
                        Trainer::class => 'Entrenador',
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('checked_in_at')
                    ->label('Ingreso')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('checked_out_at')
                    ->label('Salida')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('method')
                    ->label('Método')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'manual' => 'Manual',
                        'qr_code' => 'Código QR',
                        'biometric' => 'Biométrico',
                        'face_recognition' => 'Reconocimiento facial',
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
                //
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
            'index' => ManageAttendanceRecords::route('/'),
        ];
    }
}
