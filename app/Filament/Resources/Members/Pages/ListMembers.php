<?php

namespace App\Filament\Resources\Members\Pages;

use App\Filament\Resources\Members\MemberResource;
use App\Models\Member;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Todos'),
            'active' => Tab::make('Activos')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'active'))
                ->badge(Member::where('status', 'active')->count())
                ->badgeColor('success'),
            'inactive' => Tab::make('Inactivos')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'inactive'))
                ->badge(Member::where('status', 'inactive')->count())
                ->badgeColor('warning'),
            'suspended' => Tab::make('Suspendidos')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'suspended'))
                ->badge(Member::where('status', 'suspended')->count())
                ->badgeColor('danger'),
        ];
    }
}
