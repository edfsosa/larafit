<?php

namespace App\Filament\Resources\EquipmentMaintenances\Pages;

use App\Filament\Resources\EquipmentMaintenances\EquipmentMaintenanceResource;
use App\Models\EquipmentMaintenance;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListEquipmentMaintenances extends ListRecords
{
    protected static string $resource = EquipmentMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Todos'),
            'preventive' => Tab::make('Preventivos')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'preventive'))
                ->badge(EquipmentMaintenance::where('type', 'preventive')->count())
                ->badgeColor('success'),
            'repair' => Tab::make('Reparaciones')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'repair'))
                ->badge(EquipmentMaintenance::where('type', 'repair')->count())
                ->badgeColor('danger'),
            'inspection' => Tab::make('Inspecciones')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'inspection'))
                ->badge(EquipmentMaintenance::where('type', 'inspection')->count())
                ->badgeColor('warning'),
            'other' => Tab::make('Otros')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'other'))
                ->badge(EquipmentMaintenance::where('type', 'other')->count())
                ->badgeColor('secondary'),
        ];
    }
}
