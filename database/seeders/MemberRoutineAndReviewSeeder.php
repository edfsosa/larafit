<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\MemberRoutine;
use App\Models\Review;
use App\Models\Routine;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberRoutineAndReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::with('user')->get();
        $trainers = Trainer::with('user')->get();
        $routines = Routine::all();

        if ($members->isEmpty() || $trainers->isEmpty() || $routines->isEmpty()) {
            $this->command->warn('No hay suficientes datos para generar member_routines y reviews.');
            return;
        }

        // Paso 1: Crear MemberRoutine
        foreach ($members as $member) {
            $trainer = $trainers->random();
            $routine = $routines->random();

            $mr = MemberRoutine::create([
                'member_id' => $member->id,
                'routine_id' => $routine->id,
                'trainer_id' => $trainer->id,
                'assigned_at' => Carbon::now()->subDays(rand(5, 30)),
                'status' => collect(['not_started', 'in_progress', 'completed'])->random(),
                'notes' => fake()->sentence(),
            ]);

            // Paso 2: Crear Review (bidireccional opcional)
            $reviewerUser = $member->user;
            $reviewedUser = $trainer->user;

            if ($reviewerUser && $reviewedUser && $reviewerUser->id !== $reviewedUser->id) {
                Review::create([
                    'member_routine_id' => $mr->id,
                    'reviewer_id' => $reviewerUser->id,
                    'reviewed_id' => $reviewedUser->id,
                    'rating' => rand(3, 5),
                    'comment' => fake()->sentence(),
                ]);

                // Reseña en sentido inverso (opcional)
                if (rand(0, 1)) {
                    Review::create([
                        'member_routine_id' => $mr->id,
                        'reviewer_id' => $reviewedUser->id,
                        'reviewed_id' => $reviewerUser->id,
                        'rating' => rand(3, 5),
                        'comment' => fake()->sentence(),
                    ]);
                }
            }
        }

        $this->command->info('Se generaron member_routines y reviews exitosamente.');
    }
}
