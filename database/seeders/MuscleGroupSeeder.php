<?php

namespace Database\Seeders;

use App\Models\MuscleGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MuscleGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $muscleGroups = [
            ['name' => 'Pecho', 'description' => 'Incluye los musculos del pecho, como el pectoral mayor y menor.'],
            ['name' => 'Espalda', 'description' => 'Incluye los músculos de la espalda, como el dorsal ancho y el trapecio.'],
            ['name' => 'Piernas', 'description' => 'Incluye los músculos de las piernas, como los cuádriceps, isquiotibiales y gemelos.'],
            ['name' => 'Hombros', 'description' => 'Incluye los músculos del hombro, como el deltoides y el manguito rotador.'],
            ['name' => 'Brazos', 'description' => 'Incluye los músculos de los brazos, como bíceps y tríceps.'],
            ['name' => 'Abdomen', 'description' => 'Incluye los músculos del abdomen, como el recto abdominal y oblicuos.'],
            ['name' => 'Glúteos', 'description' => 'Incluye los músculos de los glúteos, como el glúteo mayor, medio y menor.'],

        ];

        foreach ($muscleGroups as $group) {
            MuscleGroup::updateOrCreate(
                ['name' => $group['name']],
                ['description' => $group['description']]
            );
        }
    }
}
