<?php

namespace Database\Seeders;

use App\Models\{
    Routine,
    Exercise,
};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExampleRoutineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear rutina base
        $routine = Routine::create([
            'name' => 'Rutina Total Body',
            'description' => 'Rutina completa de cuerpo entero para principiantes.',
            'difficulty' => 'beginner',
            'duration_minutes' => 45,
        ]);

        // Fase
        $phase = $routine->phases()->create([
            'name' => 'Fase 1: Adaptación',
            'order' => 1,
            'duration_weeks' => 1,
        ]);

        // Semana
        $week = $phase->weeks()->create(['week_number' => 1]);

        // Crear días
        $days = [
            ['day_name' => 'Monday', 'title' => 'Pecho y Tríceps', 'estimated_duration' => '00:45:00', 'estimated_calories' => 300],
            ['day_name' => 'Wednesday', 'title' => 'Espalda y Bíceps', 'estimated_duration' => '00:45:00', 'estimated_calories' => 300],
            ['day_name' => 'Friday', 'title' => 'Piernas y Core', 'estimated_duration' => '00:45:00', 'estimated_calories' => 300],
        ];

        foreach ($days as $dayData) {
            $day = $week->days()->create($dayData);

            // Obtener 2 ejercicios aleatorios
            $exercises = Exercise::inRandomOrder()->take(2)->get();

            foreach ($exercises as $index => $exercise) {
                $dayExercise = $day->exercises()->create([
                    'exercise_id' => $exercise->id,
                    'order' => $index + 1,
                ]);

                // Crear 3 sets por ejercicio
                for ($i = 1; $i <= 3; $i++) {
                    $dayExercise->sets()->create([
                        'type' => 'reps_weight',
                        'reps' => rand(10, 15),
                        'weight' => rand(10, 25),
                    ]);
                }
            }
        }
    }
}
