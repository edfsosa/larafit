<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EquipmentResource\Pages;
use App\Filament\Resources\EquipmentResource\RelationManagers;
use App\Models\Equipment;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EquipmentResource extends Resource
{
    protected static ?string $model = Equipment::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Equipo';
    protected static ?string $pluralLabel = 'Equipos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Descripción')
                    ->nullable()
                    ->rows(1),
                FileUpload::make('image_path')
                    ->label('Imagen')
                    ->image()
                    ->nullable()
                    ->disk('public')
                    ->directory('equipments/images'),
                TextInput::make('video_url')
                    ->label('URL del Video')
                    ->nullable()
                    ->url()
                    ->maxLength(255),
                TextInput::make('serial_number')
                    ->label('Número de Serie')
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('brand')
                    ->label('Marca')
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('model')
                    ->label('Modelo')
                    ->nullable()
                    ->maxLength(255),
                Select::make('type')
                    ->label('Tipo')
                    ->options([
                        'cardio' => 'Cardio',
                        'strength' => 'Fuerza',
                        'flexibility' => 'Flexibilidad',
                        'balance' => 'Equilibrio',
                        'mobility' => 'Movilidad',
                    ])
                    ->default('strength')
                    ->native(false)
                    ->required(),
                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'available' => 'Disponible',
                        'maintenance' => 'Mantenimiento',
                        'out_of_order' => 'Fuera de servicio',
                    ])
                    ->default('available')
                    ->native(false)
                    ->hiddenOn('create')
                    ->required(),
                DatePicker::make('purchased_at')
                    ->label('Fecha de Compra')
                    ->nullable()
                    ->native(false)
                    ->closeOnDateSelection(),
                DatePicker::make('last_service_at')
                    ->label('Último Servicio')
                    ->nullable()
                    ->native(false)
                    ->closeOnDateSelection(),
                DatePicker::make('next_service_due')
                    ->label('Próximo Servicio')
                    ->nullable()
                    ->native(false)
                    ->closeOnDateSelection(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'cardio' => 'Cardio',
                        'strength' => 'Fuerza',
                        'flexibility' => 'Flexibilidad',
                        'balance' => 'Equilibrio',
                        'mobility' => 'Movilidad',
                        default => 'Desconocido',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'available' => 'Disponible',
                        'maintenance' => 'Mantenimiento',
                        'out_of_order' => 'Fuera de servicio',
                        default => 'Desconocido',
                    })
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'available' => 'success',
                        'maintenance' => 'warning',
                        'out_of_order' => 'danger',
                        default => 'secondary',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('brand')
                    ->label('Marca')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('model')
                    ->label('Modelo')
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
            'index' => Pages\ListEquipment::route('/'),
            'create' => Pages\CreateEquipment::route('/create'),
            'edit' => Pages\EditEquipment::route('/{record}/edit'),
        ];
    }
}
