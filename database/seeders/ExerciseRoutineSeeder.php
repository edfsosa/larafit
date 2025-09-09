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
                'name' => 'Push-Up',
                'description' => 'A basic upper body strength exercise.',
                'type' => 'strength',
                'muscle_group' => 'chest',
                'video_url' => 'https://example.com/push_up_video',
            ],
            [
                'name' => 'Squat',
                'description' => 'A fundamental lower body exercise.',
                'type' => 'strength',
                'muscle_group' => 'legs',
                'video_url' => 'https://example.com/squat_video',
            ],
            [
                'name' => 'Plank',
                'description' => 'Core strengthening exercise.',
                'type' => 'strength',
                'muscle_group' => 'core',
                'video_url' => 'https://example.com/plank_video',
            ],
            [
                'name' => 'Jumping Jacks',
                'description' => 'A full-body cardio exercise.',
                'type' => 'cardio',
                'muscle_group' => 'full_body',
                'video_url' => 'https://example.com/jumping_jacks_video',
            ],
            [
                'name' => 'Lunges',
                'description' => 'A lower body strength exercise.',
                'type' => 'strength',
                'muscle_group' => 'legs',
                'video_url' => 'https://example.com/lunges_video',
            ],
            [
                'name' => 'Burpees',
                'description' => 'A high-intensity full-body exercise.',
                'type' => 'cardio',
                'muscle_group' => 'full_body',
                'video_url' => null,
            ],
            [
                'name' => "Bicep Curl",
                "description" => "An isolation exercise for the biceps.",
                "type" => "strength",
                "muscle_group" => "arms",
                "video_url" => "https://example.com/bicep_curl_video",
            ],
            [
                'name' => "Tricep Dip",
                "description" => "An exercise targeting the triceps.",
                "type" => "strength",
                "muscle_group" => "arms",
                "video_url" => "https://example.com/tricep_dip_video",
            ],
            [
                'name' => "Mountain Climbers",
                "description" => "A cardio exercise that also engages the core.",
                "type" => "cardio",
                "muscle_group" => "core",
                "video_url" => null,
            ],
            [
                'name' => "Deadlift",
                "description" => "A compound exercise targeting multiple muscle groups.",
                "type" => "strength",
                "muscle_group" => "back",
                "video_url" => "https://example.com/deadlift_video",
            ],
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }

        $routines = [
            [
                'name' => 'Full Body Beginner',
                'description' => 'A beginner-friendly full body workout routine.',
                'difficulty' => 'beginner',
                'duration_minutes' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Upper Body Strength',
                'description' => 'Focus on building upper body strength.',
                'difficulty' => 'intermediate',
                'duration_minutes' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Cardio Blast',
                'description' => 'High-intensity cardio routine to burn calories.',
                'difficulty' => 'advanced',
                'duration_minutes' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Core Focus',
                'description' => 'Strengthen your core with this targeted routine.',
                'difficulty' => 'intermediate',
                'duration_minutes' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Leg Day',
                'description' => 'A routine dedicated to lower body strength.',
                'difficulty' => 'advanced',
                'duration_minutes' => 40,
                'is_active' => true,
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
