<?php

namespace Database\Seeders;

use App\Models\Equipment;
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
                'name' => 'Cinta de correr',
                'description' => 'Cinta de correr para entrenamiento cardiovascular',
                'image_path' => 'equipment/images/cinta.png',
                'video_url' => 'https://youtu.be/ji-5miebSAk',
                'serial_number' => 'TRD123456',
                'brand' => 'FitPro',
                'model' => 'TP-2023',
                'type' => 'Cardio',
                'status' => 'Available',
                'purchased_at' => now()->subMonths(6),
                'last_service_at' => now()->subMonths(1),
                'next_service_due' => now()->addMonths(5),
            ],
            [
                'name' => 'Bicicleta estática',
                'description' => 'Bicicleta estática para entrenamiento de resistencia',
                'image_path' => 'equipment/images/bicicleta-estatica.jpg',
                'video_url' => 'https://youtu.be/hA1NoKsMnT8',
                'serial_number' => 'BST654321',
                'brand' => 'CycleMax',
                'model' => 'CM-2023',
                'type' => 'Cardio',
                'status' => 'Available',
                'purchased_at' => now()->subMonths(8),
                'last_service_at' => now()->subMonths(2),
                'next_service_due' => now()->addMonths(4),
            ],
            [
                'name' => 'Máquina de remo',
                'description' => 'Máquina de remo para entrenamiento total del cuerpo',
                'image_path' =>  'equipment/images/maquina-remo.jpg',
                'video_url' => 'https://youtu.be/6EZuR79Bp_Q',
                'serial_number' => 'MRM987654',
                'brand' => 'RowMaster',
                'model' => 'RM-2023',
                'type' => 'Cardio',
                'status' => 'Available',
                'purchased_at' => now()->subMonths(10),
                'last_service_at' => now()->subMonths(3),
                'next_service_due' => now()->addMonths(7),
            ],
        ];

        foreach ($equipments as $equipment) {
            Equipment::create($equipment);
        }
    }
}
