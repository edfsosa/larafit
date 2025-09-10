<?php

namespace App\Filament\Resources\MemberTrainers\Pages;

use App\Filament\Resources\MemberTrainers\MemberTrainerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMemberTrainer extends EditRecord
{
    protected static string $resource = MemberTrainerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
