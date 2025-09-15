<?php

namespace App\Filament\Widgets;

use App\Models\MemberRoutine;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AssignedRoutinesCount extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalRoutines = MemberRoutine::count();
        $completed = MemberRoutine::where('status', 'completed')->count();
        $inProgress = MemberRoutine::where('status', 'in_progress')->count();
        $notStarted = MemberRoutine::where('status', 'not_started')->count();

        return [
            Stat::make('Total asignadas', $totalRoutines)
                ->description('Total de rutinas asignadas a los miembros')
                ->descriptionIcon('heroicon-m-clipboard')
                ->color('info'),
            Stat::make('En progreso', $inProgress)
                ->description('Rutinas que están actualmente en progreso')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            Stat::make('Completadas', $completed)
                ->description('Rutinas que han sido completadas')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('No iniciadas', $notStarted)
                ->description('Rutinas que aún no han sido iniciadas')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}
