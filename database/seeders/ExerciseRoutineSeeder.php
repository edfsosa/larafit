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
        // Generar 10 ejercicios de ejemplo
        $exercises = [
            ['name' => 'Push-up', 'description' => 'A basic upper body exercise.', 'difficulty' => 'beginner', 'type' => 'strength'],
            ['name' => 'Squat', 'description' => 'A fundamental lower body exercise.', 'difficulty' => 'beginner', 'type' => 'strength'],
            ['name' => 'Jumping Jack', 'description' => 'A cardio exercise to get your heart rate up.', 'difficulty' => 'beginner', 'type' => 'cardio'],
            ['name' => 'Plank', 'description' => 'Core strengthening exercise.', 'difficulty' => 'intermediate', 'type' => 'strength'],
            ['name' => 'Lunge', 'description' => 'Great for leg strength and balance.', 'difficulty' => 'intermediate', 'type' => 'strength'],
            ['name' => 'Burpee', 'description' => 'Full body exercise that increases heart rate.', 'difficulty' => 'advanced', 'type' => 'cardio'],
            ['name' => 'Mountain Climber', 'description' => 'Cardio exercise that targets multiple muscle groups.', 'difficulty' => 'advanced', 'type' => 'cardio'],
            ['name' => 'Deadlift', 'description' => 'Strength training exercise for the back and legs.', 'difficulty' => 'advanced', 'type' => 'strength'],
            ['name' => 'Bench Press', 'description' => 'Upper body strength exercise focusing on the chest.', 'difficulty' => 'intermediate', 'type' => 'strength'],
            ['name' => 'Bicep Curl', 'description' => 'Isolation exercise for the biceps.', 'difficulty' => 'beginner', 'type' => 'strength'],
            ['name' => 'Tricep Dip', 'description' => 'Exercise targeting the triceps muscles.', 'difficulty' => 'beginner', 'type' => 'strength'],
            ['name' => 'Leg Press', 'description' => 'Machine-based exercise for leg strength.', 'difficulty' => 'intermediate', 'type' => 'strength'],
            ['name' => 'Shoulder Press', 'description' => 'Exercise to strengthen the shoulder muscles.', 'difficulty' => 'intermediate', 'type' => 'strength'],
            ['name' => 'Pull-up', 'description' => 'Upper body exercise that targets the back and biceps.', 'difficulty' => 'advanced', 'type' => 'strength'],
            ['name' => 'Sit-up', 'description' => 'Core exercise to strengthen abdominal muscles.', 'difficulty' => 'beginner', 'type' => 'strength'],
            ['name' => 'Russian Twist', 'description' => 'Core exercise that targets the obliques.', 'difficulty' => 'intermediate', 'type' => 'strength'],
            ['name' => 'High Knees', 'description' => 'Cardio exercise that involves running in place with high knee lifts.', 'difficulty' => 'beginner', 'type' => 'cardio'],
            ['name' => 'Butt Kicks', 'description' => 'Cardio exercise that involves running in place while kicking your heels towards your glutes.', 'difficulty' => 'beginner', 'type' => 'cardio'],
            ['name' => 'Jump Rope', 'description' => 'Cardio exercise that improves coordination and cardiovascular health.', 'difficulty' => 'intermediate', 'type' => 'cardio'],
            ['name' => 'Cycling', 'description' => 'Low-impact cardio exercise that strengthens the legs and improves cardiovascular health.', 'difficulty' => 'beginner', 'type' => 'cardio'],
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }

        $trainers = Trainer::all();

        $routines = [
            [
                'name' => 'Full Body Beginner',
                'description' => 'A beginner-friendly full body workout routine.',
                'difficulty' => 'beginner',
                'is_active' => true,
                'trainer_id' => $trainers->random()->id,
            ],
            [
                'name' => 'Upper Body Strength',
                'description' => 'Focus on building upper body strength with this routine.',
                'difficulty' => 'intermediate',
                'is_active' => true,
                'trainer_id' => $trainers->random()->id,
            ],
            [
                'name' => 'Advanced HIIT',
                'description' => 'High-intensity interval training for advanced users.',
                'difficulty' => 'advanced',
                'is_active' => true,
                'trainer_id' => $trainers->random()->id,
            ],
        ];

        foreach ($routines as $routine) {
            Routine::create($routine);
        }

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
                    'sets' => rand(3, 5),
                    'reps' => rand(8, 15),
                ]);
            }
        }
    }
}
