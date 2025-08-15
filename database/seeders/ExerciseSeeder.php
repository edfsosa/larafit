<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\MuscleGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            [
                'name' => 'Flexión de brazos',
                'description' => 'Un ejercicio básico para la fuerza de la parte superior del cuerpo.',
                'image_path' => 'exercises/images/flexion-de-brazos.jpg',
                'video_url' => 'https://www.youtube.com/shorts/cWrJFIdTje0?feature=share',
                'type' => 'strength',
                'difficulty' => 'beginner',
                'equipment_id' => null,
                'muscle_group_id' => MuscleGroup::where('name', 'Brazos')->first()->id,
                'default_sets' => 3,
                'default_reps' => 10,
                'default_rest_period' => 60,
            ],
            [
                'name' => 'Sentadilla',
                'description' => 'Un ejercicio fundamental para la fuerza de las piernas y glúteos.',
                'image_path' => 'exercises/images/sentadillas.jpg',
                'video_url' => 'https://www.youtube.com/shorts/cqoNTr02fRk?feature=share',
                'type' => 'strength',
                'difficulty' => 'beginner',
                'equipment_id' => null,
                'muscle_group_id' => MuscleGroup::where('name', 'Piernas')->first()->id,
                'default_sets' => 3,
                'default_reps' => 10,
                'default_rest_period' => 60,
            ],
            [
                'name' => 'Plancha',
                'description' => 'Un ejercicio isométrico que fortalece el core y los músculos estabilizadores.',
                'image_path' => 'exercises/images/plancha.jpg',
                'video_url' => 'https://youtu.be/zfY5XXa26ug',
                'type' => 'strength',
                'difficulty' => 'beginner',
                'equipment_id' => null,
                'muscle_group_id' => MuscleGroup::where('name', 'Abdomen')->first()->id,
                'default_sets' => 3,
                'default_reps' => 30,
                'default_rest_period' => 60,
            ]
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}
