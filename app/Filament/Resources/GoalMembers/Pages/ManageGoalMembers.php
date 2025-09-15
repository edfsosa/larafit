<?php

namespace App\Filament\Resources\GoalMembers\Pages;

use App\Filament\Resources\GoalMembers\GoalMemberResource;
use App\Models\GoalMember;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ManageGoalMembers extends ManageRecords
{
    protected static string $resource = GoalMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->label('Todos'),
            'active' => Tab::make()
                ->label('Activos')
                ->query(fn ($query) => $query->where('status', 'active'))
                ->badge(GoalMember::where('status', 'active')->count())
                ->badgeColor('info'),
            'pending' => Tab::make()
                ->label('Pendientes')
                ->query(fn ($query) => $query->where('status', 'pending'))
                ->badge(GoalMember::where('status', 'pending')->count())
                ->badgeColor('warning'),
            'completed' => Tab::make()
                ->label('Completados')
                ->query(fn ($query) => $query->where('status', 'completed'))
                ->badge(GoalMember::where('status', 'completed')->count())
                ->badgeColor('success'),
        ];
    }
}
