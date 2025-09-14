<?php

namespace App\Filament\Resources\MemberRoutines\Pages;

use App\Filament\Resources\MemberRoutines\MemberRoutineResource;
use App\Models\MemberRoutine;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListMemberRoutines extends ListRecords
{
    protected static string $resource = MemberRoutineResource::class;

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
            'not_started' => Tab::make('No Iniciadas')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'not_started'))
                ->badge(MemberRoutine::where('status', 'not_started')->count())
                ->badgeColor('danger'),
            'in_progress' => Tab::make('En Progreso')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'in_progress'))
                ->badge(MemberRoutine::where('status', 'in_progress')->count())
                ->badgeColor('warning'),
            'completed' => Tab::make('Completadas')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'completed'))
                ->badge(MemberRoutine::where('status', 'completed')->count())
                ->badgeColor('success'),
        ];
    }
}
