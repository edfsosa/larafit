<?php

namespace App\Filament\Resources\MemberTrainers\Pages;

use App\Filament\Resources\MemberTrainers\MemberTrainerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMemberTrainers extends ListRecords
{
    protected static string $resource = MemberTrainerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
