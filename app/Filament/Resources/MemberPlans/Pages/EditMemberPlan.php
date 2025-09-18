<?php

namespace App\Filament\Resources\MemberPlans\Pages;

use App\Filament\Resources\MemberPlans\MemberPlanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMemberPlan extends EditRecord
{
    protected static string $resource = MemberPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
