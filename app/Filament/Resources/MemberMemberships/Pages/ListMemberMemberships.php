<?php

namespace App\Filament\Resources\MemberMemberships\Pages;

use App\Filament\Resources\MemberMemberships\MemberMembershipResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMemberMemberships extends ListRecords
{
    protected static string $resource = MemberMembershipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
