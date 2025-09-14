<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\MemberMembership;
use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberships = [
            [
                'name' => 'Básico mensual',
                'description' => 'Acceso a funciones básicas por un mes.',
                'price' => 80000.00,
                'duration_days' => 30,
            ],
            [
                'name' => 'Premium mensual',
                'description' => 'Acceso a todas las funciones por un mes.',
                'price' => 120000.00,
                'duration_days' => 30,
            ],
            [
                'name' => 'Básico anual',
                'description' => 'Acceso a funciones básicas por un año.',
                'price' => 800000.00,
                'duration_days' => 365,
            ],
            [
                'name' => 'Premium anual',
                'description' => 'Acceso a todas las funciones por un año.',
                'price' => 1200000.00,
                'duration_days' => 365,
            ],
        ];

        foreach ($memberships as $membership) {
            Membership::create($membership);
        }

        // poblar la tabla member_memberships con datos de ejemplo
        $allMembers = Member::all();
        $allMemberships = Membership::all();

        foreach ($allMembers as $member) {
            // Asignar una membresía aleatoria a cada miembro
            $membership = $allMemberships->random();

            $startDate = now()->subDays(rand(0, 60)); // Fecha de inicio aleatoria en los últimos 60 días
            $endDate = (clone $startDate)->addDays($membership->duration_days);

            $member->memberships()->attach($membership->id, [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => $endDate->isFuture() ? 'active' : 'expired',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // poblar la tabla payments con datos de ejemplo
        $paymentMethods = ['qr_code', 'credit_card', 'debit_card', 'bank_transfer', 'cash', 'paypal'];
        $memberMemberships = MemberMembership::all();

        foreach ($memberMemberships as $memberMembership) {
            $numPayments = rand(1, 3); // Cada membresía puede tener entre 1 y 3 pagos

            for ($i = 0; $i < $numPayments; $i++) {
                $amount = $memberMembership->membership->price;
                $paymentDate = (clone $memberMembership->start_date)->addDays(rand(0, $memberMembership->membership->duration_days));

                // Asegurarse de que la fecha de pago no sea futura
                if ($paymentDate->isFuture()) {
                    $paymentDate = now()->subDays(rand(0, 30));
                }

                $memberMembership->payments()->create([
                    'amount' => $amount,
                    'date' => $paymentDate,
                    'method' => $paymentMethods[array_rand($paymentMethods)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
