<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use App\Models\MemberMembership;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class MemberStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalMembers = Member::count();
        $activeMembers = MemberMembership::where('status', 'active')
            ->whereDate('end_date', '>=', Carbon::today())
            ->distinct('member_id')
            ->count('member_id');
        $membersWithoutMembership = $totalMembers - $activeMembers;

        return [
            Stat::make('Miembros totales', $totalMembers)
                ->description('Usuarios registrados como miembros')
                ->color('info'),
            Stat::make('Con membresía activa', $activeMembers)
                ->description('Miembros con al menos una membresía vigente')
                ->color('success'),
            Stat::make('Sin membresía activa', $membersWithoutMembership)
                ->description('Miembros sin membresía o con membresía vencida')
                ->color('danger'),
        ];
    }
}
