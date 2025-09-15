<?php

namespace App\Filament\Widgets;

use App\Models\MemberMembership;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class ExpiringMemberships extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $in7Days = $today->copy()->addDays(7);
        $expiring = MemberMembership::where('status', 'active')
            ->whereBetween('end_date', [$today, $in7Days])
            ->count();
        $expired = MemberMembership::where('status', 'expired')
            ->whereDate('end_date', '<', $today)
            ->count();
        $all = MemberMembership::count();

        return [
            Stat::make('Total membresías', $all)
                ->description('Total de membresías registradas')
                ->descriptionIcon('heroicon-m-identification')
                ->color('info'),
            Stat::make('Por vencer (7 días)', $expiring)
                ->description('Membresías activas próximas a expirar')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning'),
            Stat::make('Ya vencidas', $expired)
                ->description('Membresías activas vencidas')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color('danger'),
        ];
    }
}
