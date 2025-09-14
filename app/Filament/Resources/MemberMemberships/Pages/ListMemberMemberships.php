<?php

namespace App\Filament\Resources\MemberMemberships\Pages;

use App\Filament\Resources\MemberMemberships\MemberMembershipResource;
use App\Models\MemberMembership;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListMemberMemberships extends ListRecords
{
    protected static string $resource = MemberMembershipResource::class;

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
            'active' => Tab::make('Activas')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'active'))
                ->badge(MemberMembership::where('status', 'active')->count())
                ->badgeColor('success'),
            'expired' => Tab::make('Expiradas')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'expired'))
                ->badge(MemberMembership::where('status', 'expired')->count())
                ->badgeColor('warning'),
            'cancelled' => Tab::make('Canceladas')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'cancelled'))
                ->badge(MemberMembership::where('status', 'cancelled')->count())
                ->badgeColor('danger'),
        ];
    }
}
