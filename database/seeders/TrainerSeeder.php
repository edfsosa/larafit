<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainers = [
            [
                'document_number' => 4452255,
                'name' => 'Luis Giménez',
                'birthdate' => '1990-05-15',
                'gender' => 'male',
                'phone' => '123456789',
                'email' => 'luis@example.com',
                'photo_path' => null,
                'bio' => 'Entrenador de crossfit con 5 años de experiencia.',
                'specialty' => 'crossfit',
                'is_active' => true,
            ],
            [
                'document_number' => 4452256,
                'name' => 'María López',
                'birthdate' => '1992-08-25',
                'gender' => 'female',
                'phone' => '987654321',
                'email' => 'maria@example.com',
                'photo_path' => null,
                'bio' => 'Entrenadora de yoga con 3 años de experiencia.',
                'specialty' => 'yoga',
                'is_active' => true,
            ]
        ];

        foreach ($trainers as $trainer) {
            Trainer::create($trainer);
        }
    }
}
