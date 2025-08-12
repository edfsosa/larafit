<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Trainer;
use App\Models\User;
use App\Models\WorkoutPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WorkoutPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker    = Faker::create('es_ES');
        $members  = Member::query()->where('active', true)->get();
        $trainers = Trainer::query()->get();
        $users    = User::query()->get();

        if ($members->isEmpty()) {
            $this->command?->warn('No hay miembros activos. Ejecutá MemberSeeder primero.');
            return;
        } else if ($trainers->isEmpty()) {
            $this->command?->warn('No hay entrenadores. Ejecutá TrainerSeeder primero.');
            return;
        } else if ($users->isEmpty()) {
            $this->command?->warn('No hay usuarios. Ejecutá UserSeeder primero.');
            return;
        }

        $creatorId = optional($users->first())->id;

        $defs = [
            ['title' => 'Cuerpo Completo Principiante',   'repeat_pattern' => 'weekly',   'weeks' => 4],
            ['title' => 'División Superior/Inferior',    'repeat_pattern' => 'weekly',   'weeks' => 8],
            ['title' => 'Empuje/Tiro/Piernas',       'repeat_pattern' => 'weekly',   'weeks' => 6],
            ['title' => 'HIIT + Core',          'repeat_pattern' => 'biweekly', 'weeks' => 4],
            ['title' => 'Fuerza 5x5',           'repeat_pattern' => 'weekly',   'weeks' => 6],
            ['title' => 'Hipertrofia Intermedio', 'repeat_pattern' => 'monthly', 'weeks' => 12],
            ['title' => 'Cardio y Movilidad',    'repeat_pattern' => 'weekly',   'weeks' => 4],
        ];

        // === 1) Planes por miembro ===
        foreach ($members as $member) {
            $count = random_int(1, 2);

            for ($i = 0; $i < $count; $i++) {
                $def   = $defs[array_rand($defs)];
                $title = $def['title'];

                // Fecha de inicio aleatoria en los últimos 45 días
                $start = now()->copy()->subDays(random_int(0, 45))->startOfDay();
                // ends_at = start + weeks - 1 día (incluyente)
                $end   = $start->copy()->addWeeks($def['weeks'])->subDay();

                // Estado según si el plan ya terminó o no
                $status = $end->isPast()
                    ? (random_int(0, 1) ? 'completed' : 'archived')
                    : 'active';

                WorkoutPlan::updateOrCreate(
                    [
                        'member_id'  => $member->id,
                        'title'      => $title,
                        'starts_at'  => $start->toDateString(),
                    ],
                    [
                        'trainer_id'   => $trainers->random()->id ?? null,
                        'description'  => $faker->sentence(10),
                        'status'       => $status,
                        'is_template'  => false,
                        'ends_at'      => $end->toDateString(),
                        'repeat_pattern' => $def['repeat_pattern'],
                        'created_by'   => $creatorId,
                        'updated_by'   => $creatorId,
                        'notes'        => $faker->optional()->sentence(),
                    ]
                );
            }
        }

        // === 2) Plantillas (opcionales) ===
        // NOTA: como 'member_id' es NOT NULL, asignamos las plantillas al primer miembro activo.
        $firstMember = $members->first();
        $templateDefs = [
            ['title' => 'Plantilla - Principiantes (Full Body)', 'repeat_pattern' => 'weekly'],
            ['title' => 'Plantilla - PPL 6 semanas',              'repeat_pattern' => 'weekly'],
            ['title' => 'Plantilla - HIIT 4 semanas',             'repeat_pattern' => 'biweekly'],
        ];

        foreach ($templateDefs as $tpl) {
            WorkoutPlan::updateOrCreate(
                [
                    'member_id' => $firstMember->id,
                    'title'     => $tpl['title'],
                    'is_template' => true,
                ],
                [
                    'trainer_id'    => $trainers->random()->id ?? null,
                    'description'   => 'Usar como base para nuevos planes.',
                    'status'        => 'draft',
                    'starts_at'     => null,
                    'ends_at'       => null,
                    'repeat_pattern' => $tpl['repeat_pattern'],
                    'created_by'    => $creatorId,
                    'updated_by'    => $creatorId,
                    'notes'         => 'Plantilla generada por seeder.',
                ]
            );
        }

        $this->command?->info('WorkoutPlanSeeder: planes generados correctamente.');
    }
}
