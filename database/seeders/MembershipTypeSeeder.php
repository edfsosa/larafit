<?php

namespace Database\Seeders;

use App\Models\MembershipType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Básico Mensual',
                'description' => 'Acceso a las instalaciones básicas.',
                'period' => 'monthly',
                'price' => 80000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Premium Mensual',
                'description' => 'Acceso a todas las instalaciones y clases grupales.',
                'period' => 'monthly',
                'price' => 120000.00,
                'is_active' => true,
            ],
            [
                'name' => 'VIP Mensual',
                'description' => 'Acceso ilimitado a todas las instalaciones, clases y servicios exclusivos.',
                'period' => 'monthly',
                'price' => 150000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Estudiante Mensual',
                'description' => 'Descuento especial para estudiantes con identificación válida.',
                'period' => 'monthly',
                'price' => 60000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Básico Trimestral',
                'description' => 'Acceso a las instalaciones básicas por 3 meses.',
                'period' => 'quarterly',
                'price' => 220000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Premium Trimestral',
                'description' => 'Acceso a todas las instalaciones y clases grupales por 3 meses.',
                'period' => 'quarterly',
                'price' => 360000.00,
                'is_active' => true,
            ],
            [
                'name' => 'VIP Trimestral',
                'description' => 'Acceso ilimitado a todas las instalaciones, clases y servicios exclusivos por 3 meses.',
                'period' => 'quarterly',
                'price' => 450000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Estudiante Trimestral',
                'description' => 'Descuento especial para estudiantes con identificación válida por 3 meses.',
                'period' => 'quarterly',
                'price' => 180000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Básico Anual',
                'description' => 'Acceso a las instalaciones básicas por 12 meses.',
                'period' => 'yearly',
                'price' => 800000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Premium Anual',
                'description' => 'Acceso a todas las instalaciones y clases grupales por 12 meses.',
                'period' => 'yearly',
                'price' => 1200000.00,
                'is_active' => true,
            ],
            [
                'name' => 'VIP Anual',
                'description' => 'Acceso ilimitado a todas las instalaciones, clases y servicios exclusivos por 12 meses.',
                'period' => 'yearly',
                'price' => 1500000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Estudiante Anual',
                'description' => 'Descuento especial para estudiantes con identificación válida por 12 meses.',
                'period' => 'yearly',
                'price' => 600000.00,
                'is_active' => true,
            ],
        ];
        foreach ($types as $type) {
            MembershipType::create($type);
        }
    }
}
