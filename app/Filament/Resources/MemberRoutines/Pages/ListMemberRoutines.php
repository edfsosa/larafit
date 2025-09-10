<?php

namespace App\Filament\Resources\MemberRoutines\Pages;

use App\Filament\Resources\MemberRoutines\MemberRoutineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMemberRoutines extends ListRecords
{
    protected static string $resource = MemberRoutineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
