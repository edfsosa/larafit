<?php

namespace App\Filament\Resources\EquipmentMaintenances\Pages;

use App\Filament\Resources\EquipmentMaintenances\EquipmentMaintenanceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEquipmentMaintenance extends EditRecord
{
    protected static string $resource = EquipmentMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
