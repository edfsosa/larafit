<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'document_number' => '123456789',
                'name' => 'Juan López',
                'birthdate' => '1990-01-01',
                'gender' => 'male',
                'phone' => '123-456-7890',
                'email' => 'juan@example.com',
                'address' => 'Calle Falsa 123',
                'city' => 'Areguá',
                'joined_at' => now(),
                'emergency_contact_name' => 'Pedro López',
                'emergency_contact_phone' => '987-654-3210',
                'height_cm' => 175,
                'weight_kg' => 70,
            ],
            [
                'document_number' => '987654321',
                'name' => 'María García',
                'birthdate' => '1985-05-15',
                'gender' => 'female',
                'phone' => '321-654-0987',
                'email' => 'maria@example.com',
                'address' => 'Calle Verdadera 456',
                'city' => 'Asunción',
                'joined_at' => now(),
                'emergency_contact_name' => 'Luis García',
                'emergency_contact_phone' => '654-321-0987',
                'height_cm' => 160,
                'weight_kg' => 60,
            ]
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
