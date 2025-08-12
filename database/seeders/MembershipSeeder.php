<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Membership;
use App\Models\MembershipType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = MembershipType::query()->where('is_active', true)->get();
        $members = Member::query()->where('active', true)->get();

        if ($types->isEmpty()) {
            $this->command?->warn('No hay tipos de membresía. Ejecutá MembershipTypeSeeder primero.');
            return;
        }


        $memberships = [
            [
                'member_id' => $members->first()->id,
                'membership_type_id' => $types->first()->id,
                'start_date' => now(),
                'end_date' => now()->addDays(match ($types->first()->period) {
                    'monthly' => 30,
                    'quarterly' => 90,
                    'yearly' => 365,
                }),
                'is_active' => true,
            ],
        ];

        foreach ($memberships as $membership) {
            Membership::create($membership);
        }
    }
}
