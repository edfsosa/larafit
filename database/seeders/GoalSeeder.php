<?php

namespace Database\Seeders;

use App\Models\Goal;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $goals = [
            [
                'title' => 'Pérdida de Peso',
                'description' => 'Para perder peso, seguirás un programa de ejercicios que combine entrenamiento cardiovascular y de fuerza, junto con una dieta equilibrada y controlada en calorías',
            ],
            [
                'title' => 'Ganancia Muscular',
                'description' => 'Lograrás ganancia muscular mediante un régimen de entrenamiento de resistencia enfocado en levantar pesas, con un aumento progresivo de la carga y una ingesta adecuada de proteínas',
            ],
            [
                'title' => 'Mejorar la Resistencia',
                'description' => 'Para ser más resistente, te centrarás en ejercicios cardiovasculares de larga duración, como correr, nadar o andar en bicicleta, aumentando gradualmente la intensidad y duración de tus entrenamientos',
            ],
            [
                'title' => 'Aumentar la Fuerza',
                'description' => 'Aumentarás tu fuerza mediante entrenamientos de resistencia progresiva, utilizando pesas libres, máquinas y ejercicios de peso corporal para trabajar todos los grupos musculares principales',
            ],
            [
                'title' => 'Mejorar la Flexibilidad',
                'description' => 'Mejorarás tu flexibilidad a través de una rutina regular de estiramientos y ejercicios de movilidad, incluyendo yoga o pilates para aumentar el rango de movimiento y reducir el riesgo de lesiones',
            ],
            [
                'title' => 'Rendimiento Deportivo',
                'description' => 'Optimizarás tu rendimiento deportivo con un programa de entrenamiento específico para tu deporte, que incluya ejercicios de agilidad, velocidad, fuerza y resistencia, además de técnicas de recuperación adecuadas',
            ],
            [
                'title' => 'Salud General',
                'description' => 'Mantendrás una rutina equilibrada de ejercicios cardiovasculares, de fuerza y flexibilidad para mejorar tu salud general, aumentar tu energía y bienestar, y reducir el estrés',
            ]
        ];

        $goalsIds = [];

        foreach ($goals as $goalData) {
            $goal = Goal::create($goalData);
            $goalIds[] = $goal->id;
        }

        $members = Member::all();

        foreach ($members as $member) {
            $assignedGoals = collect($goalIds)->random(rand(1, 3))->toArray();
            foreach ($assignedGoals as $goalId) {
                $member->goals()->attach($goalId, [
                    'assigned_at' => now()->subDays(rand(1, 30)),
                    'status' => ['completed', 'pending'][array_rand(['completed', 'pending'])],
                ]);
            }
        }
    }
}
