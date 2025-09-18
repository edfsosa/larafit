<?php

namespace App\Filament\Resources\TrainingPlans\Pages;

use App\Filament\Resources\TrainingPlans\TrainingPlanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTrainingPlan extends EditRecord
{
    protected static string $resource = TrainingPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
