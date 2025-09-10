<?php

namespace App\Filament\Resources\MemberMemberships\Pages;

use App\Filament\Resources\MemberMemberships\MemberMembershipResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMemberMembership extends EditRecord
{
    protected static string $resource = MemberMembershipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
