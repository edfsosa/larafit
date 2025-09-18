<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\Routine;
use Illuminate\Database\Seeder;

class RoutineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routines = [
            [
                'name' => 'Rutina Full Body para Principiantes',
                'description' => 'Entrenamiento de cuerpo completo ideal para quienes se inician en el gimnasio.',
                'difficulty' => 'beginner',
                'duration_minutes' => 45,
            ],
            [
                'name' => 'Entrenamiento de Fuerza Intermedio',
                'description' => 'Rutina centrada en hipertrofia con ejercicios básicos y compuestos.',
                'difficulty' => 'intermediate',
                'duration_minutes' => 60,
            ],
            [
                'name' => 'Circuito HIIT de Alta Intensidad',
                'description' => 'Rutina de cardio intenso para quemar grasa y mejorar resistencia.',
                'difficulty' => 'advanced',
                'duration_minutes' => 30,
            ],
            [
                'name' => 'Rutina de Core y Estabilidad',
                'description' => 'Fortalece el abdomen, zona lumbar y mejora el equilibrio.',
                'difficulty' => 'intermediate',
                'duration_minutes' => 40,
            ],
            [
                'name' => 'Flexibilidad y Movilidad Articular',
                'description' => 'Ejercicios suaves para mantener el rango de movimiento y prevenir lesiones.',
                'difficulty' => 'beginner',
                'duration_minutes' => 35,
            ],
            [
                'name' => 'Push/Pull para Avanzados',
                'description' => 'División de empuje y tracción para entrenar seis días por semana.',
                'difficulty' => 'advanced',
                'duration_minutes' => 75,
            ],
        ];

        foreach ($routines as $routine) {
            Routine::create($routine);
        }

        $this->command->info('Rutinas creadas con éxito.');

        $exercises = [
            [
                'name' => 'Sentadillas con barra',
                'description' => 'Ejercicio compuesto para fortalecer piernas y glúteos.',
                'type' => 'strength',
                'muscle_group' => 'legs',
                'equipment_id' => 3,
            ],
            [
                'name' => 'Press de banca',
                'description' => 'Ejercicio para desarrollar fuerza en el pecho y tríceps.',
                'type' => 'strength',
                'muscle_group' => 'chest',
                'equipment_id' => 5,
            ],
            [
                'name' => 'Remo con barra',
                'description' => 'Fortalece la espalda media y los bíceps.',
                'type' => 'strength',
                'muscle_group' => 'back',
                'equipment_id' => 1,
            ],
            [
                'name' => 'Plancha abdominal',
                'description' => 'Ejercicio isométrico para fortalecer el core.',
                'type' => 'strength',
                'muscle_group' => 'core',
                'equipment_id' => null,
            ],
            [
                'name' => 'Burpees',
                'description' => 'Ejercicio cardiovascular de alta intensidad que trabaja todo el cuerpo.',
                'type' => 'cardio',
                'muscle_group' => 'full_body',
                'equipment_id' => null,
            ],
            [
                'name' => 'Elevaciones laterales con mancuernas',
                'description' => 'Ejercicio para fortalecer los hombros.',
                'type' => 'strength',
                'muscle_group' => 'shoulders',
                'equipment_id' => 4,
            ],
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}
