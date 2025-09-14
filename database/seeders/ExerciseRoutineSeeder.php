<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\ExerciseRoutine;
use App\Models\Routine;
use App\Models\Trainer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseRoutineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            [
                'name' => 'Sentadilla con barra',
                'description' => 'Ejercicio de fuerza para tren inferior enfocado en cuádriceps y glúteos.',
                'type' => 'strength',
                'muscle_group' => 'legs',
            ],
            [
                'name' => 'Press de banca',
                'description' => 'Ejercicio de fuerza que trabaja principalmente el pecho y tríceps.',
                'type' => 'strength',
                'muscle_group' => 'chest',
            ],
            [
                'name' => 'Dominadas',
                'description' => 'Ejercicio de tracción que fortalece la espalda y bíceps.',
                'type' => 'strength',
                'muscle_group' => 'back',
            ],
            [
                'name' => 'Plancha abdominal',
                'description' => 'Ejercicio isométrico para fortalecer el core.',
                'type' => 'strength',
                'muscle_group' => 'core',
            ],
            [
                'name' => 'Cinta de correr',
                'description' => 'Ejercicio cardiovascular para mejorar la resistencia.',
                'type' => 'cardio',
                'muscle_group' => 'full_body',
            ],
            [
                'name' => 'Burpees',
                'description' => 'Ejercicio de cuerpo completo que combina fuerza y cardio.',
                'type' => 'cardio',
                'muscle_group' => 'full_body',
            ],
            [
                'name' => 'Estiramiento de isquiotibiales',
                'description' => 'Ejercicio de flexibilidad para mejorar la movilidad de las piernas.',
                'type' => 'flexibility',
                'muscle_group' => 'legs',
            ],
            [
                'name' => 'Elevaciones laterales con mancuernas',
                'description' => 'Ejercicio para fortalecer los deltoides (hombros).',
                'type' => 'strength',
                'muscle_group' => 'shoulders',
            ],
            [
                'name' => 'Curl de bíceps con barra',
                'description' => 'Ejercicio de aislamiento para los bíceps.',
                'type' => 'strength',
                'muscle_group' => 'arms',
            ],
            [
                'name' => 'Paseo del granjero',
                'description' => 'Ejercicio de fuerza funcional y estabilidad.',
                'type' => 'balance',
                'muscle_group' => 'core',
            ],
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }

        $this->command->info('Ejercicios creados con éxito.');

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

        // Poblar la tabla pivot exercise_routine
        $allExercises = Exercise::all();
        $allRoutines = Routine::all();
        foreach ($allRoutines as $routine) {
            // Seleccionar aleatoriamente entre 3 y 6 ejercicios para cada rutina
            $selectedExercises = $allExercises->random(rand(3, 6));
            foreach ($selectedExercises as $exercise) {
                ExerciseRoutine::create([
                    'exercise_id' => $exercise->id,
                    'routine_id' => $routine->id,
                    'sets' => rand(2, 4),
                    'reps' => rand(10, 20),
                    'rest_seconds' => rand(30, 60),
                    'duration_seconds' => null,
                    'order' => rand(1, 10),
                ]);
            }
        }
    }
}
