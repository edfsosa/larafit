<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\EquipmentMaintenance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipments = [
            [
                'name' => 'Cinta de Correr',
                'description' => 'Es una máquina de cardio para correr o caminar.',
                'type' => 'cardio',
                'image' => null,
                'video_url' => null,
                'serial_number' => 'TM123456',
                'brand' => 'FitBrand',
                'model' => 'X1000',
                'status' => 'available',
                'purchased_at' => '2023-01-15',
                'purchase_price' => 3000000.00,
            ],
            [
                'name' => 'Dumbbells Ajustables',
                'description' => 'Pesas ajustables para entrenamiento de fuerza.',
                'type' => 'strength',
                'image' => null,
                'video_url' => null,
                'serial_number' => 'DB654321',
                'brand' => 'StrongFit',
                'model' => 'DumbbellPro',
                'status' => 'available',
                'purchased_at' => '2022-11-20',
                'purchase_price' => 500000.00,
            ],
        ];

        $maintenances = [
            [
                'equipment_id' => 1,
                'date' => '2023-06-01',
                'type' => 'routine',
                'description' => 'Mantenimiento preventivo anual.',
                'cost' => 150000.00,
            ],
            [
                'equipment_id' => 2,
                'date' => '2023-05-15',
                'type' => 'repair',
                'description' => 'Reparación de ajuste de peso.',
                'cost' => 80000.00,
            ],
        ];

        foreach ($equipments as $equipment) {
            Equipment::create($equipment);
        }

        foreach ($maintenances as $maintenance) {
            EquipmentMaintenance::create($maintenance);
        }
    }
}
