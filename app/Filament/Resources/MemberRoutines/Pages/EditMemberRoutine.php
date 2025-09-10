<?php

namespace App\Filament\Resources\MemberRoutines\Pages;

use App\Filament\Resources\MemberRoutines\MemberRoutineResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMemberRoutine extends EditRecord
{
    protected static string $resource = MemberRoutineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
