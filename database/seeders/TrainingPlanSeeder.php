<?php

namespace Database\Seeders;

use App\Models\TrainingPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Plan para Principiantes',
                'description' => 'Un plan diseñado para aquellos que están comenzando su viaje de fitness.',
                'difficulty' => 'beginner',
                'is_template' => true,
            ],
            [
                'name' => 'Plan Intermedio',
                'description' => 'Un plan para aquellos que ya tienen algo de experiencia en el entrenamiento.',
                'difficulty' => 'intermediate',
                'is_template' => true,
            ],
            [
                'name' => 'Plan Avanzado',
                'description' => 'Un plan desafiante para atletas experimentados.',
                'difficulty' => 'advanced',
                'is_template' => true,
            ],
        ];

        foreach ($plans as $plan) {
            TrainingPlan::create($plan);
        }
    }
}
