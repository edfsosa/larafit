<?php

namespace App\Filament\Resources\EquipmentMaintenances;

use App\Filament\Resources\EquipmentMaintenances\Pages\CreateEquipmentMaintenance;
use App\Filament\Resources\EquipmentMaintenances\Pages\EditEquipmentMaintenance;
use App\Filament\Resources\EquipmentMaintenances\Pages\ListEquipmentMaintenances;
use App\Filament\Resources\EquipmentMaintenances\Schemas\EquipmentMaintenanceForm;
use App\Filament\Resources\EquipmentMaintenances\Tables\EquipmentMaintenancesTable;
use App\Models\EquipmentMaintenance;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EquipmentMaintenanceResource extends Resource
{
    protected static ?string $model = EquipmentMaintenance::class;
    protected static ?string $navigationLabel = 'Mantenimientos';
    protected static ?string $modelLabel = 'Mantenimiento';
    protected static ?string $pluralModelLabel = 'Mantenimientos';
    protected static ?int $navigationSort = 2;
    protected static string | UnitEnum | null $navigationGroup = 'Activos';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    public static function form(Schema $schema): Schema
    {
        return EquipmentMaintenanceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EquipmentMaintenancesTable::configure($table);
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
            'index' => ListEquipmentMaintenances::route('/'),
            'create' => CreateEquipmentMaintenance::route('/create'),
            'edit' => EditEquipmentMaintenance::route('/{record}/edit'),
        ];
    }
}
